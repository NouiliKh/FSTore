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

$id=$_GET['id'];

$stmt=$dbh->prepare("DELETE FROM orderuser WHERE idor=:id");
$stmt->bindParam(":id",$id);
$stmt->execute();

$auth_user->redirect('checkout.php');


?>