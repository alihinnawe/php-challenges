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

abstract class Package
{
    private string $itemName;
    private string $itemType;
    private int $itemNbr = 0;

    public function __construct(string $iName, string $iType)
    {
        $this->itemName = $iName;
        $this->itemType = $iType;
    }
    abstract public function setValue(int $itemNbr);

    public function getDetails(): array
    {
        return [
            'Name' => $this->itemName,
            'Type' => $this->itemType,
            'Number' => $this->itemNbr
        ];
    }
}


class ProductsArray extends Package {
    private int $itemNumber = 0;
    public function setValue($itemNumber) : int {

        return $this -> itemNumber;
    }
}
?>

<?php
    $package =  new ProductsArray("Electronics","handys");
    print_r($package -> setValue(1000));
?>

<p></p>
<p><a href="https://www.w3schools.com/php/php_oop_what_is.asp">W3 Tutorial PHP OOP</a></p>
</body>
</html>
