<?php
ob_start();
$pdo = new PDO("mysql:host=localhost;dbname=absoluteTest", "root", "");

if(!isset($_COOKIE['user_id'])) {
	if(isset($_POST['submit'])) {
		$user_name = trim($_POST['name']);
		var_dump($_POST);
		$user_password = sha1(trim($_POST['password']));
		if(!empty($user_name) && !empty($user_password)){
			$sql = "SELECT COUNT(*) FROM `user` WHERE name = :name AND password = :password";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['name' => $user_name, 'password' => $user_password]);
            $result = $stmt->fetchColumn();
			if($result === '1') {
                $sql = "SELECT `user_id` , `name`, `role` FROM `user` WHERE name = :name AND password = :password";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['name' => $user_name, 'password' => $user_password]);
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				if (!is_null($row['role'])){
                    setcookie('user_id', $row['user_id'], time() + (60*60*24*30));
                    setcookie('name', $row['name'], time() + (60*60*24*30));
                    setcookie('role', $row['role'], time() + (60*60*24*30));
                    header('Location: ' . '/housework.php');
                }else{
				echo 'Your account have no role, ask admin';
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
    $pdo = null;
}
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
<content>
</content>
<section>
<?php
	if(empty($_COOKIE['name'])) {
?>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="name">Enter login:</label>
        <input type="text" name="name">
        <label for="password">Enter password:</label>
        <input type="password" name="password">
        <button type="submit" name="submit">Enter</button>
        <a href="signup.php">Registration</a>
    </form>
        <ul>
            <li>dad/dad</li>
            <li>mom/mom</li>
            <li>child1/child1</li>
            <li>child2/child1</li>
            <li>child3/child3 (without role)</li>
        </ul>
	</form>
<?php
}
else {
    header('Location: ' . '/housework.php');
}
?>
</section>


<footer class="clear">
    <p>All rights reserved</p>
</footer>

</body>

</html>

<?php
ob_flush();
?>