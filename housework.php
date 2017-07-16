<?php

ob_start();
session_start();
ini_set('session.cookie_lifetime', '30');

$name = $_SESSION['name'];
$role = $_SESSION['role'];

if (!($name || $role)){
    header('Location: ' . '/index.php');
}
require "HouseworkDB.php";
$housework = new HouseworkDB();

$errMsg = "";
$message = "";

?>
<!DOCTYPE html>
<html>
<head>
    <title><?=$name?> page</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="style/style.css" rel="stylesheet">

</head>
<body>

<div class="container">
    <header><p><a href="exit.php">Exit(<?php echo $name; ?>)</a></p></header>
        <?php
        if(!empty($name)){
            include "get_housework.inc.php";
        }
        if($role == 'mother'){
            include "uploadFile.inc.php";
        }elseif($role == 'father'){
            include "distribute.inc.php";
        }
    ?>
    <?php
    if (!empty($message)){
        echo "<h3>$message</h3>";
    }elseif (!empty($errMsg)){
        echo "<h3>$errMsg</h3>";
    }
    ?>
</div>
</body>
</html>
<?php
    ob_flush();
?>


