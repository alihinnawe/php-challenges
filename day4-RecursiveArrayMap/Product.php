
<?php

class Product {
    private $pName;
    private $pType;
    private $articleNbr;
    public function __construct(String $c, String $b) {
        $this -> pName = $c;
        $this -> pType = $b;
    }
    public  function testi () : String {

        return "product name is: " .  $this ->pName . " type: " . $this ->pType . "\n";
    }

    public function setValue(int $articelNumber ) : int {
        return $this -> articleNbr = $articelNumber;
    }
    public function getArticleNbrValue() : int {
        return $this -> articleNbr;
    }
}

?>

<?php
$product =  new Product(
    "Handy","Iphone");
print_r($product -> testi());
$product -> setValue(100);
print_r($product -> getArticleNbrValue());
?>
