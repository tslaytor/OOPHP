<?php  

require_once 'ProductBase.php';

class Furniture extends ProductBase
{
    private int $height;
    private int $width;
    private int $length;

    public function __construct($sku, $name, $price, $height=0, $width=0, $length=0, $id=null)
    {
        parent::__construct($sku, $name, $price, $id);

        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function setLength(int $length): void
    {
        $this->length = $length;
    }

    public function getProperty(): string
    {
        return 'Dimension: ' .
        $this->height . 
        'x' . $this->width . 
        'x' . $this->length;
    }

}
