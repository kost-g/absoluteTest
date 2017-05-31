<h4>Housework list</h4>
<?php
$housework_arr = $housework->getHousework($name);
if (empty($housework_arr)){
    $errMsg = "Error during housework printing";
}
if(isset($_POST['submit'])){
    unset($_POST['submit']);
    $setDone = array_keys($_POST);
    $housework->setHouseworkDone($setDone);
    header('Location: ' . '/index.php');
}
?>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <th>№</th>
        <th>Housework</th>
        <th>Done</th>
    </tr>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <?php
    foreach($housework_arr as $item){
        ?>
        <tr> <td><?= $item['housework_id']?></td>
            <td><?= $item['content']?></td>
            <td><input type="checkbox" name='<?=$item['housework_id']?>' value="1">done<br></td>
        </tr>
        <?php
    }
    ?>
    <button type="submit" name="submit">Save</button>
    </form>


