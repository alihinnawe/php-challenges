<html>
   <head>
      <title>Übung OOP</title>
      <link href="css/style.css" rel="stylesheet" type="text/css"/>
   </head>
   <body>
   <h3>Übung o1 oop ()</h3>
   <p>Legen Sie eine Klasse für ein Produkt an und schützen Sie die Eigenschaften vor einem Zugriff von aussen.</p>
       <h3>Lösung o1 oop ()</h3>

   <?php

   class Product {
       private String $pName;
       private String $pType;
       private int $articleNbr = 0;


       public function __construct(String $name, String $type) {
           $this -> pName = $name;
           $this -> pType = $type;
       }
       public  function testi () : String {

           return "product name is: " .  $this ->pName . " type: " . $this ->pType . "\n";
       }

       public function setValue(int $articelNumber ) : int {

           $this -> articleNbr = $articelNumber;
           return  $this -> articleNbr;
       }
       public function getArticleNbrValue() : int {
           return $this -> articleNbr;
       }
   }

   class ProductsArray extends Product {

        private $productsArray = [];
        public function setProcuctArray($arrayOfProducts) : Array {
            $this -> productsArray = $arrayOfProducts;
            return $this -> productsArray;
        }

       public function getProcuctArray() : Array {

           return $this -> productsArray;
       }

   }
   ?>

   <?php
   $product1 =  new Product(
       "Handy","Iphone");
   print_r($product1 -> testi());
   $product1 -> setValue(100);
   print_r($product1 -> getArticleNbrValue());

   $product2 =  new Product(
       "Handy","Samsung");
   print_r($product2 -> testi());
   $product2 -> setValue(101);
   print_r($product2 -> getArticleNbrValue());

   $product3 =  new Product(
       "Handy","Xiomi");
   print_r($product3 -> testi());
   $product3 -> setValue(102);
   print_r($product3 -> getArticleNbrValue());
   ////////////////////////////////////////////

   $productsArrayObject = new ProductsArray("test","test");
   $productsArrayObject -> setProcuctArray(array($product1,$product2,$product3));
   print_r($productsArrayObject -> getProcuctArray());
   ?>

   <p></p>
   <p><a href="https://www.w3schools.com/php/php_oop_what_is.asp">W3 Tutorial PHP OOP</a></p>
   </body>
</html>
