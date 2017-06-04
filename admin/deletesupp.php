<?php
require_once("../session.php");
require_once("../classuser.php");

$auth_user = new USER();
$database=new Database();
$dbh = $database->dbConnection();



$user_id = $_SESSION['user_session'];

$stmt = $auth_user->runQuery("SELECT * FROM users WHERE id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

$ido = $_GET['idf'];

$query = $dbh->prepare("DELETE FROM suppliers
                                  WHERE idf=$ido");

$query->execute();
$auth_user->redirect('suppliers.php');

?>