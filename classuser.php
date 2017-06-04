<?php

require_once('dbconfig.php');

class USER
{

    private $conn;

    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function runQuery($sql)
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }

    public function register($uname, $umail, $upass)
    {
        try {
            $new_password = password_hash($upass, PASSWORD_DEFAULT);

            $stmt = $this->conn->prepare("INSERT INTO users(fullName,email,password,role) 
		                                               VALUES(:uname, :umail, :upass,'user')");

            $stmt->bindparam(":uname", $uname);
            $stmt->bindparam(":umail", $umail);
            $stmt->bindparam(":upass", $new_password);

            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function doLogin($umail, $upass)
    {
        try {
            $stmt = $this->conn->prepare("SELECT id, fullName, email, password FROM users WHERE email=:umail ");
            $stmt->execute(array(':umail' => $umail));
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() == 1) {
                if (password_verify($upass, $userRow['password'])) {
                    $_SESSION['user_session'] = $userRow['id'];
                    return true;
                } else {
                    return false;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function is_loggedin()
    {
        if (isset($_SESSION['user_session'])) {
            return true;
        }
    }


    public function redirect($url)
    {
        header("Location: $url");
    }


    public function doLogout()
    {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
    }


    public function newpdt($id,$namep,$idf,$descr,$pic,$price,$cate,$quan,$max,$min)
    {

        try {
            $stmt = $this->conn->prepare("INSERT INTO products( idpdct,namep,idf,descri,pic1,price,category,quantity,maxp,minp) 
		                                               VALUES(:id,:namep,:idf,:descr,:pic,:price,:cate,:quan,:maxp,:minp)");

            $stmt->bindparam(":id", $id);
            $stmt->bindparam(":namep", $namep);
            $stmt->bindparam(":idf", $idf);
            $stmt->bindparam(":descr", $descr);
            $stmt->bindparam(":pic", $pic);
            $stmt->bindparam(":cate", $cate);
            $stmt->bindparam(":price", $price);
            $stmt->bindparam(":quan", $quan);
            $stmt->bindparam(":maxp", $max);
            $stmt->bindparam(":minp", $min);
            $stmt->execute();


            return $stmt;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }


    }


    public function updatepdct($id,$namep,$idf,$descr,$pic,$price,$cate,$quan,$maxp,$minp,$ido)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE  products
                                                    SET idpdct=:id ,namep=:namep,idf=:idf,descri=:descr,pic1=:pic,price=:price,
                                                    category=:cate,quantity=:quan,maxp=:maxp,minp=:minp
                                                    WHERE idpdct=:ido");
            $stmt->bindparam(":id", $id);
            $stmt->bindparam(":namep", $namep);
            $stmt->bindparam(":idf", $idf);
            $stmt->bindparam(":descr", $descr);
            $stmt->bindparam(":pic", $pic);
            $stmt->bindparam(":cate", $cate);
            $stmt->bindparam(":price", $price);
            $stmt->bindparam(":quan", $quan);
            $stmt->bindparam(":maxp", $maxp);
            $stmt->bindparam(":minp", $minp);
            $stmt->bindparam(":ido", $ido);

            $stmt->execute();


            return $stmt;

        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }


    }


    public function newsupp($ids,$namesup,$adress,$tel,$fax)
    {

        try {
            $stmt = $this->conn->prepare("INSERT INTO suppliers( idf,namesup,adress,fax,tel) 
		                                               VALUES(:ids,:namesup,:adress,:fax,:tel)");

            $stmt->bindparam(":ids", $ids);
            $stmt->bindparam(":namesup", $namesup);
            $stmt->bindparam(":adress", $adress);
            $stmt->bindparam(":tel", $tel);
            $stmt->bindparam(":fax", $fax);
            $stmt->execute();


            return $stmt;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }


    }


    public function updatesupp($ids,$namesup,$adress,$tel,$fax,$ido)
    {

        try {
            $stmt = $this->conn->prepare("    UPDATE suppliers
		                                               SET idf=:ids,namesup=:namesup,adress=:adress,fax=:fax,tel=:tel
		                                               WHERE idf=:ido");

            $stmt->bindparam(":ids", $ids);
            $stmt->bindparam(":ido", $ido);
            $stmt->bindparam(":namesup", $namesup);
            $stmt->bindparam(":adress", $adress);
            $stmt->bindparam(":tel", $tel);
            $stmt->bindparam(":fax", $fax);
            $stmt->execute();


            return $stmt;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }



    public function neworder($ido,$quan,$idf,$price,$quano){
        try {
            $stmt = $this->conn->prepare("INSERT INTO orders (idf,idpdct,qcom,pricef,datepur) 
                                                    VALUES(:idf,:ido,:quan,:pricef,:datepur ) ");
            $pricef=($price * $quan);
            $datepur=date("Y/m/d");

            $stmt->bindparam(":ido", $ido);
            $stmt->bindparam(":idf", $idf);
            $stmt->bindparam(":quan", $quan);
            $stmt->bindparam(":pricef",$pricef);
            $stmt->bindparam(":datepur",$datepur);
            $stmt->execute();

            $newq=$quano+$quan;


            $rqt = $this->conn->prepare("UPDATE products
                                                    SET quantity=:newq
                                                    WHERE idpdct=:ido");
            $rqt->bindParam(":ido",$ido);
            $rqt->bindParam(":newq",$newq);
            $rqt->execute();

            return $stmt;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }


    }



    public function updateorder($ido,$quan,$quano,$price,$quanp,$idp)
    {
        try {
            $stmt = $this->conn->prepare("    UPDATE orders
		                                               SET qcom=:quan,pricef=:newprice
		                                               WHERE idc=:ido");
            $newprice=$price*$quan;
            $stmt->bindparam(":quan", $quan);
            $stmt->bindparam(":newprice", $newprice);
            $stmt->bindParam(":ido",$ido);
            $stmt->execute();


            $rqt =$this->conn->prepare("UPDATE products
                                                  SET quantity=:newq
                                                  Where idpdct=:idp ");
            $newq = $quanp-$quano+$quan;
            $rqt->bindParam(":newq",$newq);
            $rqt->bindParam(":idp",$idp);
            $rqt->execute();
            return $stmt;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function updateus($idu,$namef,$mail,$role)
    {

        try {
            $stmt = $this->conn->prepare("    UPDATE users
		                                               SET fullName=:namef,email=:mail,role=:role
		                                               WHERE id=:idu");

            $stmt->bindparam(":idu", $idu);
            $stmt->bindparam(":namef", $namef);
            $stmt->bindparam(":mail", $mail);
            $stmt->bindparam(":role", $role);
            $stmt->execute();


            return $stmt;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }


    public function newuser($fulln,$mail,$role){
        try {
            $stmt = $this->conn->prepare("INSERT INTO users (fullName,email,role) 
                                                    VALUES(:fulln,:mail,:role ) ");

            $stmt->bindparam(":fulln", $fulln);
            $stmt->bindparam(":mail", $mail);
            $stmt->bindparam(":role", $role);
            $stmt->execute();

            return $stmt;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }


    }


}


?>