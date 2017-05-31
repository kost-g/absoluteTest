<?php
//     Check for load class
// Include class
$name = $_COOKIE['name'];
$role = $_COOKIE['role'];

if (!($name || $role)){
    header('Location: ' . '/index.php');
}
require_once "HouseworkDB.php";
$housework = new HouseworkDB();
$errMsg = "";

?>
<!DOCTYPE html>
<html>
<head>
    <title><?=$name?> page</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="style/style.css" rel="stylesheet">

</head>
<body>
<header><p><a href="exit.php">Exit(<?php echo $name; ?>)</a></p></header>

<?php
    if (!empty($errMsg)){
        echo "<h3>$errMsg</h3>";
    }
?>

<div class="container">
    <?php
        if($role == 'mother'){
            include "uploadFile.inc.php";
        }elseif($role == 'father'){
            include "distribute.inc.php";
        }
        if(!empty($name)){
            include "get_housework.inc.php";
        }
    ?>
</div>

</body>
</html>