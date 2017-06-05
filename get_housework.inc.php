
<?php
$housework_arr = $housework->getHousework($name);

if (empty($housework_arr)){
    $message = "Housework list is empty, or all housework is done ";
}elseif(!$housework_arr){
    $errMsg = "Error during housework printing";
}
if(isset($_POST['submit'])){
    unset($_POST['submit']);
    $setDone = array_keys($_POST);
    $housework->setHouseworkDone($setDone);
    $home_url = 'http://' . $_SERVER['HTTP_HOST'];
    header('Location: '. $home_url);
}
?>

<div class="housework">
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="panel panel-default">
        <div class="panel-heading">Housework list</div>
        <table class="table table-bordered">
            <tr>
                <th>Id №</th>
                <th>Housework</th>
                <th>Done</th>
            </tr>
                <?php
                foreach($housework_arr as $item){
                    ?>
                    <tr> <td><?= $item['housework_id']?></td>
                        <td><?= $item['content']?></td>
                        <td><input type="checkbox" name='<?=$item['housework_id']?>' value="1"></td>
                    </tr>
                    <?php
                }
                ?>
        </table>
    </div>
    <div class="form-group">
        <button type="submit" name="submit" class="btn btn-success">Save</button>
    </div>
    </form>
</div>

