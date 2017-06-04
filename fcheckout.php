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



$query=$dbh->prepare("SELECT quantity,idp FROM orderuser WHERE iduser = :user_id");
$query->bindParam(":user_id",$user_id);
$query->execute();
$rslt=$query->fetchAll();
$i=0;
foreach ($rslt as  $row){
    $idp=$row[1];
$qry=$dbh->prepare("SELECT quantity FROM products WHERE idpdct=:idp");
$qry->bindParam(":idp",$idp);
$qry->execute();
$rst=$qry->fetchAll();
$newq=$rst[0][$i]-$row[0];


$qr=$dbh->prepare("UPDATE products SET quantity=:newq WHERE idpdct=:idp");
$qr->bindParam(":idp",$idp);
$qr->bindParam(":newq",$newq);
$qr->execute();

$i=$i+1;

}

$qrr=$dbh->prepare("DELETE FROM orderuser WHERE  iduser =:user_id");
$qrr->bindParam(":user_id",$user_id);
$qrr->execute();


$auth_user->redirect('success.php');

?>