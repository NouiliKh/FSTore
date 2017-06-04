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

$idc = $_GET['id'];
$query = $dbh->prepare("SELECT * FROM orders WHERE idc=$idc");
$query->execute();
$result = $query->fetchall();

foreach ($result as $row) {
    $quano=$row['qcom'];
    $idp=$row['idpdct'];
}

$qr = $dbh->prepare("SELECT * FROM products WHERE idpdct=$idp");
$qr->execute();
$res = $qr->fetchall();
foreach ($res as $row) {
    $quanp=$row['quantity'];
}

$query = $dbh->prepare("DELETE FROM orders
                                  WHERE idc=$idc");
$query->execute();

$rqt =$dbh->prepare("UPDATE products
                              SET quantity=:newq
                               Where idpdct=:idp ");

echo dqsdsq;
$newq = $quanp-$quano;
$rqt->bindParam(":newq",$newq);
$rqt->bindParam(":idp",$idp);
$rqt->execute();

$auth_user->redirect('orders.php');


?>
