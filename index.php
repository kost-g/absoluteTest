<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<title>Enter page</title>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="style/style.css" rel="stylesheet">

</head>
<body>
<header>
</header>
<div class="container">
<?php
    if(!isset($_SESSION['user_id'])){
        if(isset($_POST['submit'])){
            $user_name = trim($_POST['name']);
            $user_password = trim($_POST['password']);
            if(!empty($user_name) && !empty($user_password)){
                require("bd.php");
                $sql = "SELECT COUNT(*) FROM `user` WHERE name = :name ";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['name' => $user_name]);
                $result = $stmt->fetchColumn();
                if($result == '1') {
                    $sql = "SELECT `user_id` , `name`, `role`, `password` FROM `user` WHERE name = :name";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['name' => $user_name]);
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if (is_null($row['role'])){
                        echo 'Your account have no role, ask admin';
                    }
                    if (password_verify($user_password, $row['password'])){
                        $_SESSION['user_id']=$row['user_id'];
                        $_SESSION['name']=$row['name'];
                        $_SESSION['role']=$row['role'];
                        header('Location: ' . '/housework.php');
                    }else{
                        echo 'Sorry, you must enter a valid password';
                    }
                }
                else {
                    echo 'Sorry, you must enter a valid username and password';
                }
            }
            else {
                echo 'Sorry, you must fill in the fields correctly';
            }
        }
        $stmt = null;
        $result = null;
    }
    ?>
<section>
<?php
	if(empty($_SESSION['user_id'])) {
?>
    <h3 style="text-align: center">Enter form</h3>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label for="name">Enter login:</label>
            <input type="text" name="name" class="form-control" placeholder="username" value="<?php echo @$_POST['name']?>">
        </div>
        <div class="form-group">
            <label for="password">Enter password:</label>
            <input type="password" name="password" class="form-control" placeholder="password">
        </div>
        <button type="submit" name="submit" class="btn btn-default">Enter</button>
        <a href="signup.php" style="float:right">Registration</a>
    </form>
        <ul style="margin-top: 20px">
            <li>dad/dad</li>
            <li>mom/mom</li>
            <li>child1/child1</li>
            <li>child2/child1</li>
            <li>child3/child3 (without role)</li>
        </ul>
<?php
}
else {
    header('Location: ' . '/housework.php');
}
?>
</section>
</div>
</body>

</html>

<?php
//var_dump($GLOBALS);
//phpinfo();
ob_flush();
?>