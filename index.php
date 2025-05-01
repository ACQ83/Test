<!doctype html>
<html lang="ru">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

<h3>ToDo List</h3>
<form id ="active" method="POST">
    <p><input type = "text" name = "newTask"/><input type="submit" value="send"></p>
    <table border = 1>
    <thead>
    <tr><th>N</th><th>Date</th><th>Text Task</th><th>Status</th><th>Priority</th><th>Remove</th></tr></thead><tbody><tr>

    <?php

    require_once 'functions.php';
    $taskNumber = 1;
    foreach (getArrayForTable() as $row) {
        
        $state = $row["status"]?" checked":"";
        $priority = (int)$row["priority"];
        $task = htmlspecialchars($row["task"],ENT_QUOTES);
        $rowName = $row["name"];
    ?>
        <tr><td><?= $taskNumber ?></td>
        <td><?= date('d.m.Y H:i:s', $row["date"]) ?></td>
        <td><?= $task ?></td>
        <td><?= getState($rowName, $state) ?></td>
        <td><select name="p[<?= $rowName ?>]">
        <?= getOptionSelect($priority) ?></select></td>
        <td><button type="submit" name ="d[<?= $rowName ?>]">Remove</button></td><?php $taskNumber++;
    }         
            ?>
    </tr></tbody></table>
    <p><input type="submit" value="Save"></p>
</form>
</body>
</html>