<?php  

// This class's static "getList()" function select all product from the database 
// and returns a sorted array of Product objects

require_once 'Connection.php';
require_once 'product_classes/Dvd.php';
require_once 'product_classes/Book.php';
require_once 'product_classes/Furniture.php';

class ProductLister
{
    public static function getList(): void
    {
        $pdo = Connection::getInstance()->getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // // get all dvd products

        $statement = $pdo->prepare('SELECT sku, name, price, size, id FROM products WHERE type_id = :type_id');
        $statement->execute(['type_id'=> Dvd::getTypeId()]);
        $dvd = $statement->fetchAll(
            PDO::FETCH_FUNC, 
            function ($sku, $name, $price, $size, $id) { 
                return new Dvd($sku, $name, $price, $size, $id); 
            });

        // get all book products
        $statement = $pdo->prepare('SELECT sku, name, price, weight, id FROM products WHERE type_id = :type_id');
        $statement->execute(['type_id'=> Book::getTypeId()]);
        $book = $statement->fetchAll(
            PDO::FETCH_FUNC, 
            function ($sku, $name, $price, $weight, $id) { 
                return new Book($sku, $name, $price, $weight, $id); 
            });
        // get all furniture products
        $statement = $pdo->prepare('SELECT sku, name, price, height, width, length, id FROM products WHERE type_id = :type_id');
        $statement->execute(['type_id'=> Furniture::getTypeId()]);
        $furniture = $statement->fetchAll(
            PDO::FETCH_FUNC, 
            function ($sku, $name, $price, $height, $width, $length, $id) { 
                return new Furniture($sku, $name, $price, $height, $width, $length, $id); 
            });
        // merge and sort by primary key
        $list = array_merge(array_merge($dvd, $book), $furniture);
        usort($list, function($a, $b) {
            return $a->getId() - $b->getId();
        });

        foreach ($list as $item): ?>
            <div style="border: solid black 2px; margin: 1rem; padding: 1rem"> 
                <?php echo 
                $item->getSku() . '<br>' .
                $item->getName() . '<br>' .
                $item->getPriceAsCurrency() . '<br>' .
                $item->getProperty() . '<br>' 
                ?> 
            </div> 
        <?php endforeach;
    }
}