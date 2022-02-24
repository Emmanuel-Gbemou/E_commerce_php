<?php
//print_r(dirname($_SERVER['SCRIPT_NAME']));exit();

define("SRC",dirname(__FILE__));
define("ROOT",dirname(SRC));
define("SP",DIRECTORY_SEPARATOR);
define("CONFIG",ROOT.SP."config");
define("VIEWS",ROOT.SP."view");
define("MODEL",ROOT.SP."model");
define("BASE_URL",dirname(dirname($_SERVER['SCRIPT_NAME'])));
define("TVA",20);

//IMPORT MODEL:

require CONFIG.SP."config.php";
require MODEL.SP."DataLayer.class.php";
$model  = new DataLayer();
$category = $model->getCategory();
// print_r($category);exit();
// $data = $model->getProduct(5,1);
// print_r($data);exit();

//juste pour le texte:

    // print_r()$var = $data->CreateCustomers('mariame','mariame@gmail.com','mariame2020');
    //$auth = $data->authentifier('ester@test.com','ester2020');
    //print_r($auth);exit();
    //$data->updateInfosCustomer(array('id'=>3,'pseudo'=>'Mari','firstname'=>'Mari','sexe'=>1,'email'=>'Mari@gmail.com','password'=>'mari2020','lastname'=>'traore','tel'=>'06239087'));
    //print_r($var);exit();
    //$products = $data->getProduct();
    //var_dump($products);exit();

//les functions appelees par le controller:
require "functions.php";

 ?>