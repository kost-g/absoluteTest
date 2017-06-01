<?php
$distribute_arr = $housework->getDistributeHousework();
$responsible = $housework->getResponsible();

if (empty($distribute_arr)){
    $message = "Housework list is empty, or all housework is done ";
}elseif(!$distribute_arr){
    $errMsg = "Error during housework printing";
}
if(isset($_POST['submit2'])){
    unset($_POST['submit2']);
    var_dump($_POST);
    $housework->setDistributeHousework($_POST);
    $home_url = 'http://' . $_SERVER['HTTP_HOST'];
    header('Location: '. $home_url);
}
?>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <th>№</th>
        <th>Housework</th>
        <th>Responsible</th>
    </tr>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <?php
    foreach($distribute_arr as $item){
        ?>
        <tr> <td><?= $item['housework_id']?></td>
            <td><?= $item['content']?></td>
            <td>
                <select name="<?= $item['housework_id']?>">
                    <?php
                        foreach ($responsible as $person){
                            ?>
                            <option value="<?= $person?>"
                                    <?php if($person == $item['responsible']){
                                       ?>
                                        selected
                                    <?php
                                    }
                                    ?>
                                    >
                                <?= $person?>
                            </option>
                        <?php
                        }
                    ?>
                </select>
            <br></td>
        </tr>
        <?php
    }
    ?>
    <button type="submit" name="submit2">Save</button>
</form>