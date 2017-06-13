<?php

$pdo = new PDO("mysql:host=localhost;dbname=absoluteTest", "root", "");

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>SignUp page</title>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="style/style.css" rel="stylesheet">
</head>
<body>
<header>
<ul>

</ul>
</header>
<div class="container">
    <?php
    if(isset($_POST['submit'])){
        $name = trim($_POST['name']);
        $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
        if(!empty($name) && !empty($password)){
            $sql = "SELECT COUNT(*) FROM user WHERE name = :name";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['name' => $name]);
            $result = $stmt->fetchColumn();
            if ($result === '0') {
                $stmt =$pdo->prepare("INSERT INTO `user` (`name`, `password`) VALUES (:name, :password)");
                $stmt->execute(['name' => $name, 'password' => $password]);
                ?>
                <div class="alert alert-success" role="alert">Successful registration</div>
                <?
            }
            else if($result === '1'){
                ?>
                <div class="alert alert-danger" role="alert">Login exist</div>
                <?
            }
        }
        $stmt = null;
        $result = null;
        $pdo = null;
    }
    ?>
    <h3 style="text-align: center">Registration form</h3>
	<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label for="name">Enter login:</label>
            <input type="text" name="name" class="form-control" placeholder="username">
        </div>
        <div class="form-group">
            <label for="password">Enter password:</label>
            <input type="password" name="password" class="form-control" placeholder="password">
        </div>
        <button type="submit" name="submit" class="btn btn-default">Enter</button>
        <a href="index.php" style="float:right">Enter in account</a>
	</form>
</div>

</body>

</html>