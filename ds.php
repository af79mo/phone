<?php

class ds
{
public $pdo;
private $dbname;
private $userr;
private $password;
public $tbl;
public function __construct($dbname="phonebook",$userr="root",$password=""){
    $this->dbname=$dbname;
    $this->userr=$userr;
    $this->password=$password;
    $this->conection();
}
public function conection(){
    try {
        $this->pdo=new PDO("mysql:host=localhost;dbname={$this->dbname}",$this->userr,$this->password);
    }
    catch (Exception $e){
        die("ارور".$e->getMessage());
    }
}
public function settbl($tbl)
{
    $this->tbl=$tbl;
}
/*
public function selectdata($s){
    if (is_array($s)){
        $d="'".implode("','",$s)."'";
    }
    $f=$this->pdo->prepare("select {$d} FROM {$this->tbl}");
    $f->execute();
    $row=$f->fetchAll(PDO::FETCH_OBJ);
   var_dump($row);
}
*/
    public function insertdata($value,$str){
        if (is_array($str)){
            $st="'".implode("','",$str)."'";
            $vl=implode(",",$value);
            $j=$this->pdo->prepare("INSERT INTO {$this->tbl} ($vl) VALUES ($st)");
            //var_dump($j);
            $j->execute();
        }
    }
    public function editData($fild,$value,$id){
        foreach ($fild as $a=>$b){
            $tyx[]=$b."='".$value[$a]."'";

        }
        $l=implode(",",$tyx);
        $query=$this->pdo->prepare("UPDATE {$this->tbl} SET ".$l."WHERE id='$id'");
        $query->execute();
        //var_dump($query);
    }
    public function deleteata($id){
        $sql=$this->pdo->prepare("DELETE FROM {$this->tbl} WHERE id=:id");
        $sql->bindparam("id",$id,PDO::PARAM_INT);
        $sql->execute();
    }
    public function searchdata($name,$value){
        $sql=$this->pdo->prepare("SELECT * FROM {$this->tbl} WHERE $name='$value'");
        $sql->execute();
        $res[]=$sql->fetchAll(PDO::FETCH_OBJ);var_dump($res);



   }
    public function searchdatalike($name,$value){
        $sql=$this->pdo->prepare("SELECT * FROM {$this->tbl} WHERE $name LIKE'$value'");
        $sql->execute();
        $res=$sql->fetch(PDO::FETCH_OBJ);
        var_dump($res);
    }
}

$obj=new ds();
$obj->settbl('usertbl');
//$obj->editData(array("username","email"),['mg','mg@gmail.com'],3);
//$obj->selectdata(['username','email']);
//$obj->insertdata(array("username","email"),['bg','bg@gmail.com']);
//$obj->deleteata('5');
//$obj->searchdatalike("username","zhra");
$obj->searchdata("username","mg");
