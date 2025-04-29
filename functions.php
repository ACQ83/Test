<?php 

if (isset($_POST['newTask']) && !empty(trim($_POST['newTask']))) {
    addNewTask($_POST['newTask']); 
}

if (isset($_POST)) {
    saveChanges($_POST);
}

if (isset($_POST['d'])) {
    deleteTask($_POST['d']); 
}



function addNewTask(string $text)  
{
    $name = bin2hex(random_bytes(4));
    $newTask = [];
    $newTask["date"] = time();
    $newTask["task"] = $text;
    $newTask["status"] = false;
    $newTask["name"] = $name;
    $newTask["priority"] = 0;
    if (!file_exists('task')) { 
        mkdir('task', 0777, true);
        chmod('task',0777);
    }
    $path = './task/' . $name;
    file_put_contents($path, json_encode($newTask));    
}

function saveChanges($changes)
{
    foreach($changes['s']  as $key => $value) {
        $path = './task/' . $key;
        $baseArr = json_decode(file_get_contents($path), TRUE);
        if (file_exists($path)) {
            $baseArr["status"] = $value;
            file_put_contents($path, json_encode($baseArr));
        }
    }
    foreach($changes['p']  as $key => $value) {
        $path = './task/' . $key;
        $baseArr = json_decode(file_get_contents($path), TRUE);
        if (file_exists($path)) {
            $baseArr["priority"] = $value;
            file_put_contents($path, json_encode($baseArr));
        }
    }

}

function deleteTask($delete) 
{   
    foreach($delete as $key => $value) {
        $path = './task/' . $key;
        unlink($path);
    }
}

if ($_POST) {
      header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
}
?>

