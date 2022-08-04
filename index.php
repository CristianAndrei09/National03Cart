<?php
include 'classes/Product.php';
include 'classes/Category.php';
include "functions.php";

 //$product = findOneBy('products','id',4);
 //var_export($product);

 //$productdinDB = new Product($id);
 $category = new Product(5);
 $productObj = new Product(1);
 var_dump($productObj);
?>
<html>
<h3><?php echo $productObj->name; ?></h3>

<?php

    //function getCalulatedPrice($product){
    //return $product['price'] =$product['price'] - ($product['price'] * $product['discount'] /100 );


?>
<h3><?php echo $productObj->getCalculatedPrice(); ?></h3>
</html>
