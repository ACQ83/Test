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
    <p><input type = "text" name = "newTask"/><input type="submit" value="send" form="active"></p>
    <?php
        include 'functions.php';
    ?> 
</form>
<form>
    <table border = 1>
    <thead>
    <tr><th>N</th><th>Date</th><th>Text Task</th><th>Status</th><th>Priority</th><th>Remove</th></tr></thead><tbody><tr>
    <?php
        include 'output.php';
    ?> 
    </tr></tbody></table>
</form>
<p><input type="submit" value="Save" form="active"></p>
</body>
</html>