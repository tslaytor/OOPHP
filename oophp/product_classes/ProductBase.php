<?php  

require_once 'Connection.php';
require_once 'Save.php';

abstract class ProductBase
{
    
    private string $sku;
    private string $name;
    private int $price;
    private ?int $id;

    public function __construct($sku='', $name='', $price=0, $id=null)
    {
        
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->id = $id;
    }

    abstract protected function getProperty(): string;

    public static function getTypeId()
    {
        $pdo = Connection::getInstance()->getPdo();
        $statement = $pdo->prepare('SELECT id FROM type WHERE type = :type');
        $statement->execute(['type' => static::class]);
        return $statement->fetchColumn();;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
   
    public function getPrice(): int
    {
        return $this->price;
    }

    public function SetPrice(int $price): int
    {
        return $this->price = $price;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPriceAsCurrency(string $symbol = "$"): string
    {   
        return $symbol . number_format((float)$this->getPrice() / 100, 2);
    }

    public function getSize(): ?int
    {
        return null;
    }

    public function getWeight(): ?int
    {
        return null;
    }

    public function getHeight(): ?int
    {
        return null;
    }

    public function getWidth(): ?int
    {
        return null;
    }

    public function getLength(): ?int
    {
        return null;
    }

    public function save(): void
    {
        Save::saveProduct($this);
    }
}
