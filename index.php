<?php
require_once 'config/dbconnect.php';

$DEFAULT_TABLE = 'test';

$queryTables = "SHOW TABLES;";
$tables = mysqli_query($connect, $queryTables);

$queryDefaultTable = "SELECT * FROM $DEFAULT_TABLE";
$defaultTable = mysqli_query($connect, $queryDefaultTable);

$defaultTableArray = [];
while ($row = mysqli_fetch_array($defaultTable)) {
    $defaultTableArray[] = $row;
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Kirill 🇺🇦</title>
</head>
<body>
<div class="container">
    <div class="select-section">
        <select class="select">
            <?php while ($row = mysqli_fetch_array($tables)): ?>
                <option <?= $row[0] === $DEFAULT_TABLE ? 'selected' : '' ?> value="<?= $row[0] ?>"><?= $row[0] ?></option>
            <?php endwhile; ?>
        </select>
        <button type="button" class="select-btn btn">OK</button>
    </div>
    <div class="table-section">
        <table class="table">
            <thead>
            <tr>
                <? $tableKeys = []; ?>
                <?php foreach ($defaultTableArray[0] as $fieldKey => $itemField): ?>
                    <?php if (!is_numeric($fieldKey)): ?>
                        <?php $tableKeys[] = $fieldKey; ?>
                        <th><?= $fieldKey ?></th>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($defaultTableArray as $row): ?>
                    <tr>
                        <?php foreach ($tableKeys as $tableKey): ?>
                            <td><?= $row[$tableKey] ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="form-section">
        <h2>Добавить запись</h2>
        <table class="table">
            <thead>
            <tr>
                <?php foreach ($tableKeys as $tableKey): ?>
                    <th><?= $tableKey ?></th>
                <?php endforeach; ?>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach ($tableKeys as $tableKey): ?>
                        <td><input name="<?=$tableKey?>" type="text"></td>
                    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>
        <button type="button" class="insert-submit btn">Отправить</button>


        <br><br>
        <h2>Произвольный SQL запрос</h2>
        <textarea name="sql" id="sql" cols="60" rows="10"></textarea>
        <button type="button" class="sql-submit btn">Отправить</button>
    </div>
</div>
<script type="application/javascript" src="js/script.js"></script>
</body>
</html>