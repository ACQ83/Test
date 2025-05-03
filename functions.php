<?php 
    $root = $_SERVER["DOCUMENT_ROOT"];
    $dir = $root . '/task/';
    if (!file_exists($dir)) { 
        mkdir($dir, 0755, true);
    }




if (isset($_POST['newTask']) && !empty(trim($_POST['newTask']))) {
    addNewTask($_POST['newTask']); 
}

if (isset($_POST)) {
    saveChanges($_POST);
}

if (isset($_POST['d']) && empty(trim($_POST['newTask']))) {
    deleteTask($_POST['d']);
}



function getState(string $rowName, string $state)
{
    echo "<input type=\"hidden\" name =\"s[$rowName]\" value = \"0\" form = \"active\"><input type=\"checkbox\" name=\"s[$rowName]\"".$state." form = \"active\" onchange=\"this.form.submit()\"";
}


function getOptionSelect(int $priority)
{   
    $outText = "";
    for ($j = 0; $j < 11; $j++) {
            if($j === $priority) {
                $outText = $outText."<option value=\"$j\" selected>$j</option>";
                continue;
                }
                 $outText = $outText."<option value=\"$j\">$j</option>";
        }
        echo $outText;
}

function getArrayForTable()
{
    $arr = scandir('./task/');
    $arrForTable = [];
    foreach ($arr as $name) {
        if(is_file('./task/' . $name)){
            $jsonArray = json_decode(file_get_contents('./task/' . $name), TRUE);
            $arrForTable[] = $jsonArray;
        }
    }

    arsort($arrForTable);
    usort($arrForTable, 'function_DESC'); 
    uasort($arrForTable, 'function_ASC');

    return $arrForTable;
}

function addNewTask(string $text)  
{   
    $name = bin2hex(random_bytes(4));
    $path = './task/' . $name;
    while (file_exists($path)) {
        $name = bin2hex(random_bytes(4));
        $path = './task/' . $name;
    }    
    $newTask = [];
    $newTask["date"] = time();
    $newTask["task"] = $text;
    $newTask["status"] = false;
    $newTask["name"] = $name;
    $newTask["priority"] = 0;
    file_put_contents($path, json_encode($newTask));    
}

function saveChanges($changes)
{   
    if(isset($changes['s'])) {
        foreach($changes['s']  as $key => $value) {
            $path = './task/' . $key;
            if (file_exists($path)) {
                $baseArr = json_decode(file_get_contents($path), TRUE);
                $baseArr["status"] = $value;
                $baseArr["priority"] = $changes['p'][$key];
                file_put_contents($path, json_encode($baseArr));
            }
        }
    }
}

function deleteTask($delete) 
{   
    var_dump($delete);
    foreach($delete as $key => $value) {
        $path = './task/' . $key;
        unlink($path);
    }
}


function function_ASC($a, $b){
    return ($a['status'] > $b['status']);
}

function function_DESC($a, $b){
    return ($a['priority'] < $b['priority']);
}

if ($_POST) {
      header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
}


?>