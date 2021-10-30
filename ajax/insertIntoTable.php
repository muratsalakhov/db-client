<?php

require_once '../config/dbconnect.php';

$data = [];
if (!empty($_POST)) {
    $data = $_POST;
}

$post = json_decode(file_get_contents('php://input'), true);
if (json_last_error() == JSON_ERROR_NONE) {
    $data = $post;
}

$tableName = $data['table'];

$query = "INSERT INTO $tableName ";
$fields = [];
$values = [];
foreach ($data as $key => $value) {
    if ($key == 'table') {
        continue;
    }
    $fields[] = $key;
    $values[] = is_numeric($value) ? $value : '"' . $value . '"';
}

$query .= '(' . implode(', ', $fields) . ') VALUES (' . implode(', ', $values) . ');';

$table = mysqli_query($connect, $query);
print_r($query);

$queryTable = "SELECT * FROM $tableName";
$table = mysqli_query($connect, $queryTable);

if (mysqli_errno($connect)) {

}

$tableArray = [];
while ($row = mysqli_fetch_array($table)) {
    $tableArray[] = $row;
}
?>

<div class="table-section">
    <table class="table">
        <thead>
        <tr>
            <? $tableKeys = []; ?>
            <?php foreach ($tableArray[0] as $fieldKey => $itemField): ?>
                <?php if (!is_numeric($fieldKey)): ?>
                    <?php $tableKeys[] = $fieldKey; ?>
                    <th><?= $fieldKey ?></th>
                <?php endif; ?>
            <?php endforeach; ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tableArray as $row): ?>
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