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

$idp=$_GET['id'];
$stm = $dbh->prepare("SELECT * FROM orderuser WHERE idp=:idp AND iduser=:user_id");
$stm->bindParam(":user_id",$user_id );
$stm->bindParam(":idp",$idp);
$stm->execute();
$result = $stm->fetchall();
foreach ($result as $row) {
    $quantity = $row['quantity'];
}
if ($result){
    $newq=$quantity+1;
    $query = $dbh->prepare("UPDATE orderuser SET quantity=:newq WHERE idp=:idp AND iduser=:user_id  ");
    $query->bindParam(":user_id",$user_id );
    $query->bindParam(":idp",$idp);
    $query->bindParam(":newq",$newq);
    $query->execute();
}

else {
    $query = $dbh->prepare("INSERT INTO orderuser (iduser,idp,quantity) VALUES (:user_id,:idp,1) ");
    $query->bindParam(":user_id",$user_id );
    $query->bindParam(":idp", $idp);

    $query->execute();
}
$auth_user->redirect('shop-grid-left.php');

?>