<?php
class DataLayer
{
    //conexion of the database:

    private $bdd;
    public function __construct()
    {

        try {
            $this->bdd = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, DB_USER, PASSWORD);
            //echo "Connexion Bien reussie";
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    //CREATE CUSTOMERS:

    function CreateCustomers($pseudo, $email, $password)
    {

        $sql = "INSERT INTO customers (pseudo,email,password) VALUES (:pseudo,:email,:password)";
        try {
            $result = $this->bdd->prepare($sql);
            $var =  $result->execute(array(
                ":pseudo" => $pseudo,
                ":email" => $email,
                ":password" => sha1($password),
            ));
            if ($var) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }
    }

    //CONNEXION OF CUSTOMERS:

    function authentifier($email, $password)
    {

        $sql = "SELECT * FROM customers WHERE email=:email";
        try {
            $result = $this->bdd->prepare($sql);
            $result->execute(array(":email" => $email));
            $data = $result->fetch(PDO::FETCH_ASSOC);
            if ($data && ($data['password'] == sha1($password))) {
                unset($data['password']);
                return $data;
            } else {
                return "Authentification echouee";
            }
        } catch (PDOException $th) {
            return NULL;
        }
    }

    //CREATE ORDERS OF CUSTOMER :

    function CreateOrders($idCustomers, $idProduct, $quantity, $price)
    {

        $sql = "INSERT INTO `orders`(`id_customers`, `id_product`, `quantity`, `price`) VALUES (:idCustomers,:idProduct,:quantity,:price)";
        try {
            $result = $this->bdd->prepare($sql);
            $var = $result->execute(array(
                "id_customers" => $idCustomers,
                ":idProduct" => $idProduct,
                ":quantity" => $quantity,
                ":price" => $price
            ));
            if ($var) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }
    }

    //UPDATE CUSTOMERS:
    //signature:EMMA

    function UpdateInfosCustomer($newInfos)
    {

        $sql = "UPDATE customers SET ";
        try {
            foreach ($newInfos as $key => $value) {

                $sql .= "$key = '$value',";
            }
            $sql = substr($sql, 0, -1);
            $sql .= " WHERE id= :id";
            $result = $this->bdd->prepare($sql);
            $var = $result->execute(array('id' => $newInfos['id']));
            if ($var) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }
        // print_r($sql);
        // exit();
    }

    //Category All: 

    function getCategory()
    {

        $sql = "SELECT * FROM category ";
        try {
            $result = $this->bdd->prepare($sql);
            $var =  $result->execute();
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
            if ($data) {
                return $data;
            } else {
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }
    }

    //PRODUCT ALL: 
    function getProduct($limit = NULL,$category = NULL,$id=NULL){
        $sql = "SELECT * FROM product ";
        if(!is_null($id)){
            $sql .= ' WHERE id = '.$id;
        }
        if(!is_null($category)){
            $sql .= 'WHERE category ='.$category;
        }
       // var_dump($sql);
        if(!is_null($limit)){
            $sql .= ' LIMIT '.$limit;
        }
      
        try {
            $result = $this->bdd->prepare($sql);
            $var =  $result->execute();
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
            if ($data) {
                return $data;
            } else {
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }
    }
}
