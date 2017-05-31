<?php

$pdo = new PDO("mysql:host=localhost;dbname=absoluteTest", "root", "");

if(isset($_POST['submit'])){
    $name = trim($_POST['name']);
    $password = sha1(trim($_POST['password']));
	if(!empty($name) && !empty($password)){
        $sql = "SELECT COUNT(*) FROM user WHERE name = :name";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['name' => $name]);
        $result = $stmt->fetchColumn();
        if ($result === '0') {
            $stmt =$pdo->prepare("INSERT INTO `user` (`name`, `password`) VALUES (:name, :password)");
            $stmt->execute(['name' => $name, 'password' => $password]);
			echo 'Successful registration';
		}
		else if($result === '1'){
			echo 'Login exist';
		}
	}
	$stmt = null;
	$result = null;
    $pdo = null;
}

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
<content>
	<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<label for="name">Enter login:</label>
	<input type="text" name="name">
	<label for="password">Enter password:</label>
	<input type="password" name="password">
	<button type="submit" name="submit">Enter</button>
    <a href="index.php">Enter in account</a>
	</form>
</content>
<footer class="clear">
	<p>All rights reserved</p>
</footer>

</body>

</html>