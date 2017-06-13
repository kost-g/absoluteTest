
<?php
$housework_arr = $housework->getHousework($name);

if (empty($housework_arr)){
    $message = "Housework list is empty, or all housework is done ";
}elseif(!$housework_arr){
    $errMsg = "Error during housework printing";
}
if(isset($_POST['submit'])){
    $housework_all = [];
    foreach($housework_arr as $item){
        $housework_all [(int) $item['housework_id']] = $item['done'];
    }
    var_dump($housework_all);
    echo "$housework_all"."<br>";

    unset($_POST['submit']);
    $setDone = $_POST;
    var_dump($_POST);
    echo "_POST"."<br>";
    foreach($housework_all as $key=> $val){
        if(array_key_exists($key, $setDone )){
            $housework_all[$key] = "1";
        }else{
            $housework_all[$key] = "0";
        }
    }
    $housework->setHouseworkDone($housework_all);
    echo "$housework_all"."<br>";
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
                        <td><input type="checkbox" name='<?=$item['housework_id']?>' value="1"
                            <? if($item['done'] == 1){
                                ?> checked <?}?>
                            ></td>
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

