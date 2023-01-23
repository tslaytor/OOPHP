<head>
    <script src="products.js"></script>
</head>

<?php  

require_once 'form_classes/Form.php';
require_once 'product_classes/Dvd.php';
require_once 'product_classes/Book.php';
require_once 'product_classes/Furniture.php';

// make a new form
$productForm = new Form();

// create a new form group for sku code
$skuWrap = new FormInputWrap(cssClass:'formGroup');
$skuWrap->inputElements([new TypedInput(id:'sku', label:'SKU', type:'text', required:true)]);
$productForm->addInput($skuWrap);

// create a new form group for product name
$nameWrap = new FormInputWrap(cssClass:'formGroup');
$nameWrap->inputElements([new TypedInput(id:'name', label:'Name', type:'text', required:true)]);
$productForm->addInput($nameWrap);

// create a new form group for the price
$priceWrap = new FormInputWrap(cssClass:'formGroup');
$priceWrap->inputElements([new TypedInput(id:'price', label:'Price', type:'number', required:true)]);
$productForm->addInput($priceWrap);

// create the product type switcher
$productForm->addInput(new SelectInput(id:'productType', label:'Type Switcher', options:['Dvd', 'Book', 'Furniture']));

// create a new form group for the size property
$sizeWrap = new FormInputWrap(cssClass:'formGroup sizeWrap');
$sizeWrap->inputElements([new TypedInput(id:'size', label:'Size', type:'number')]);
$productForm->addInput($sizeWrap);

// create a new form group for the weight property
$weightWrap = new FormInputWrap(cssClass:'formGroup weightWrap');
$weightWrap->inputElements([new TypedInput(id:'weight', label:'Weight', type:'number')]);
$productForm->addInput($weightWrap);

// create a new form group for the dimension properties (height, width and length)
$dimensionWrap = new FormInputWrap(cssClass:'dimensionWrap');
$dimensionWrap->inputElements([
    new TypedInput('height', 'Height', 'number'), 
    new TypedInput('width', 'Width', 'number'), 
    new TypedInput('length', 'Length', 'number')]);
$productForm->addInput($dimensionWrap);

// add the submit button to the form
$productForm->addInput(new TypedInput('submit', '', 'submit'));

// display the form
echo $productForm->display(id:'productForm', method:'post');

// 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $product = $_POST['productType'];
    unset($_POST['productType'], $_POST['submit']);
    $args = array_filter($_POST);

    foreach ($args as $key => $value) {
        echo $key . ": " . $value . "<br>";
        echo $args[$key] . "<br>";
    }
    $newProduct = new $product(...$args);
    // var_dump($newProduct->getName(), $newProduct->getPrice(),$newProduct->getSku(),$newProduct->getheight(), $newProduct->getLength(), $newProduct->getWidth(),$newProduct->getWeight(),$newProduct->getSize());
    $newProduct->save();
}