<?php
require_once("session.php");
require_once("classuser.php");

$auth_user = new USER();
$database=new Database();
$dbh = $database->dbConnection();

$user_id = $_SESSION['user_session'];

$stmt = $auth_user->runQuery("SELECT * FROM users WHERE id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

$newq[]=$_POST['qty'];

$query=$dbh ->prepare("SELECT idor FROM orderuser WHERE iduser=:user_id ");
$query->bindParam(":user_id",$user_id);
$query->execute();
$rslt=$query->fetchAll();
$i=0;

foreach ($rslt as $row){
    $qua=$newq[0][$i];
    $ido=$row[0];
    $qry = $dbh->prepare("UPDATE orderuser SET quantity=:newq WHERE idor=:ido");
    $qry->bindParam(":ido",$ido);
    $qry->bindParam(":newq",$qua);
    $qry->execute();
$i=$i+1;

  $auth_user->redirect('checkout.php');

}


?>