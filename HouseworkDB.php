<?php

class HouseworkDB{
//    const DB_NAME = "../news.db";
//    const RSS_NAME = "rss.xml";
//    const RSS_TITLE = "Последние новости";
//    const RSS_LINK = "http://borisovoop/news/news.php";
    private $pdo;

//    function __get($name){
//        if ($name == "_db") {
//            return $this->_db;
//            throw new Exception("Unknown property!");
//        }
//    }
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
    public function setDistributeHousework($setData){
        $stmt = $this->pdo->prepare("Update housework SET responsible = :responsible where housework_id = :id");
        $stmt->execute($setData);
    }
    public function setHouseworkDone($setDone){
        $in  = str_repeat('?,', count($setDone) - 1) . '?';
        $stmt = $this->pdo->prepare("Update housework SET done = 1 where housework_id IN ($in)");
        $stmt->execute($setDone);
    }
}