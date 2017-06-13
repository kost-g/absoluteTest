<?php

class HouseworkDB{
    private $pdo;
    public function __construct(){
        $this->pdo = new PDO("mysql:host=localhost;dbname=absoluteTest", "root", "");
    }
    public function __destruct(){
        unset($this->_db);
    }
    public function getHousework($name){
        $stmt = $this->pdo->prepare("SELECT * FROM housework WHERE responsible = :name ORDER BY DONE");
        $stmt->execute(['name' => $name]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getDistributeHousework(){
        $stmt = $this->pdo->prepare("SELECT * FROM housework");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getResponsible(){
        $stmt = $this->pdo->prepare("SELECT name FROM user");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    public function setDistributeHousework($setData){
        $stmt = $this->pdo->prepare("Update housework SET responsible = ? where housework_id = ?");
        foreach ($setData as $id => $responsible)
        {
            $stmt->execute([$responsible,$id]);
        }
    }
    public function setHouseworkDone($setDone){
        $stmt = $this->pdo->prepare("Update housework SET done = :done where housework_id = :id");
        foreach ($setDone as $key=> $val)
        {
            $stmt->execute(['done' => $val, 'id' => $key]);
        }
    }
    public function importFile($uploadfile){
        //prepare path for file downloading
        $uploaddir = implode("/", (explode( "\\" , $_FILES["file"]["tmp_name"], -3))) . '/domains/absoluteTest/uploads/' . time() . ".txt";
        move_uploaded_file($uploadfile, $uploaddir);
        $f = fopen("$uploaddir", "r") or die("Impossible open file");

        $stmt_1 = $this->pdo->prepare("INSERT INTO `housework` (`content`) VALUES (:content)");
        $stmt_2 = $this->pdo->prepare("INSERT INTO `files` (`file_path`) VALUES (:file_path )");

        try {
            $this->pdo->beginTransaction();
            $tasks = [];
            while($task = fgets($f)){
                $tasks[]= $task;
            }

//            housework storing
            foreach ($tasks as $id => $content)
            {
                $stmt_1->execute([":content" => $content]);
            }

//            housework files storing
            $stmt_2->execute([":file_path" => $uploaddir]);
            $this->pdo->commit();
            return true;

        } catch (Exception $e) {
            $this->pdo->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

}