<?
    // Check for load class
    function __autoload($name){
        require "$name.class.php";
    }
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        print_r($_FILES);
        // $tmp = $_FILES['user']['tmp_name'];
        // $name = $_FILES[]['name'];
    }
