<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<form id ="active" method="POST">
    <table border = 1>
    <caption>ToDo List</caption>
    <thead>
    <tr>
        <th>Date</th>
        <th>Text Task</th>
        <th>Status</th>
        <th>Priority</th>
        <th>Remove</th>
    </tr>
</thead>
<tbody>
    <?php

    require_once 'functions.php';
    foreach (getArrayForTable() as $row) {
        $state = $row["status"]?" checked":"";
        $priority = (int)$row["priority"];
        $task = htmlspecialchars($row["task"],ENT_QUOTES);
        $rowName = $row["name"];
    ?>
        <tr>
        <td><?= date('d.m.Y H:i:s', $row["date"]) ?></td>
        <td><?= $task ?></td>
        <td><?= getState($rowName, $state) ?></td>
        <td><select name="p[<?= $rowName ?>]" onchange="this.form.submit()">
        <?= getOptionSelect($priority) ?></select></td>
        <td><button type="submit" name = "d[<?= $rowName ?>]">Remove</button></td>
    <?php } ?>
    </tr>
</tbody>
</table>
<p><input type = "text" name = "newTask"><input type="submit" value="send"></p>
</form>

</body>
</html>