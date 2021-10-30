<?php

require_once '../config/dbconnect.php';

$tableName = $_GET['table'];

$query = "";
if (!empty($_POST)) {
    $query = $_POST['query'];
}

$post = json_decode(file_get_contents('php://input'), true);
if (json_last_error() == JSON_ERROR_NONE) {
    $query = $post['query'];
}

if ($query) {

    $table = mysqli_query($connect, $query);

    $tableArray = [];
    while ($row = mysqli_fetch_array($table)) {
        $tableArray[] = $row;
    }

    $hasString = false;
    foreach ($tableArray[0]  as $fieldKey => $itemField) {
        if (!is_numeric($fieldKey)) {
            $hasString = true;
        }
    }

    print_r($tableArray);
}
?>
<div class="table-section">
    <table class="table">
        <thead>
        <tr>
            <? $tableKeys = []; ?>
            <?php foreach ($tableArray[0] as $fieldKey => $itemField): ?>
                <?php if ($hasString): ?>
                    <?php if (!is_numeric($fieldKey)): ?>
                        <?php $tableKeys[] = $fieldKey; ?>
                        <th><?= $fieldKey ?></th>
                    <?php endif; ?>
                <?php else: ?>
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
