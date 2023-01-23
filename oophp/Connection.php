<?php  

class Connection
{
    private static $instance = null;
    private PDO $pdo;

    private string $host = 'localhost';
    private string $dbname = 'oophp';
    private string $charset = 'utf8mb4';

    private const OPTIONS = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    private function __construct()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
        
        try {
            $this->pdo = new PDO($dsn, 'root', 'root', self::OPTIONS);
        } catch (PDOException $exception) {
            throw new PDOException($exception->getMessage(), (int) $exception->getCode());
        }
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getPdo(): ?PDO
    {
        return $this->pdo;
    }
}