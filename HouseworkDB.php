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
        $stmt = $this->pdo->prepare("SELECT * FROM housework WHERE responsible = :name  AND done = 0 ");
        $stmt->execute(['name' => $name]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getDistributeHousework(){
        $stmt = $this->pdo->prepare("SELECT * FROM housework WHERE done = 0 ");
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
        $in  = str_repeat('?,', count($setDone) - 1) . '?';
        $stmt = $this->pdo->prepare("Update housework SET done = 1 where housework_id IN ($in)");
        $stmt->execute($setDone);
    }
    public function importFile($uploadfile){
        $f = fopen("$uploadfile", "r") or die("Impossible open file");
        $tasks = [];
        while($task = fgets($f)){
            $tasks[]= $task;
        }
        var_dump($tasks);
        $stmt = $this->pdo->prepare("INSERT INTO `housework` (`content`) VALUES (:content)");
            foreach ($tasks as $id => $content)
        {
            $stmt->execute([":content" => $content]);
        }
        fclose($f);
    }
}