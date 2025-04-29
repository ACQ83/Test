<?php 

 drawingTable(); 

function drawingTable()
{
    $arr = scandir('./task/');
    $i = 0;
    foreach ($arr as $name) {
        if(is_file('./task/' . $name)){
            $jsonArray = json_decode(file_get_contents('./task/' . $name), TRUE);
            $arrForSort[] = $jsonArray;
        }   
    }

    arsort($arrForSort);

    usort($arrForSort, 'function_DESC'); 

    uasort($arrForSort, 'function_ASC'); 

    foreach ($arrForSort as $row) {
            $checked = $row["status"]?" checked":"";
            $priority = (int) $row["priority"];
            $task = htmlspecialchars($row["task"],ENT_QUOTES);
            $rowName = $row["name"];
            echo 
            "<tr><td>{$i}</td>
            <td>".date('d.m.Y H:i:s', $row["date"])."</td>
            <td>".$task."</td>
            <td><input type=\"hidden\" name =\"s[$rowName]\" value = \"0\" form = \"active\"><input type=\"checkbox\" name=\"s[$rowName]\"".$checked." form = \"active\"></td>
            <td><select name=\"p[$rowName]\" form = \"active\">";
            for ($i=0; $i < 11; $i++) {
                if($i==$priority) {
                    echo "<option value=\"$i\" selected>$i</option>";
                }
                 echo "<option value=\"$i\">$i</option>";
            }

            echo "</select></td>
            <td>
            <button type=\"submit\" name =\"d[$rowName]\" form = \"active\">Remove</button></td>";
            $i++;
    }         
}  

function function_ASC($a, $b){
    return ($a['status'] > $b['status']);
}
function function_DESC($a, $b){
    return ($a['priority'] < $b['priority']);
}

?>


