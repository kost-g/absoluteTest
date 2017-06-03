
<?php
$housework_arr = $housework->getHousework($name);

if (empty($housework_arr)){
    $message = "Housework list is empty, or all housework is done ";
}elseif(!$housework_arr){
    $errMsg = "Error during housework printing";
}
if(isset($_POST['submit'])){
    var_dump($_POST);
    $setDone = array_keys($_POST);
    $housework->setHouseworkDone($setDone);
    $home_url = 'http://' . $_SERVER['HTTP_HOST'];
    header('Location: '. $home_url);
}
?>

<div>
    <h4>Housework list</h4>
    <div>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <table border="1" cellpadding="5" cellspacing="0" width="100%">
            <tr>
                <th>№</th>
                <th>Housework</th>
                <th>Done</th>
            </tr>
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
        </table>
        <button type="submit" name="submit">Save</button>
        </form>
    </div>
</div>

