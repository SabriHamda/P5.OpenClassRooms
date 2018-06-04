<?php
namespace etc\db;

use PDOException;
use PDO;
/**
 * Description of Database
 *
 * @author Sabri Hamda
 */
class Database
{

    private static $instance = null;
    private $pdo;
    

    private function __construct()
    {
        $config = require __DIR__.'./../../config/db.php';
        try {
            $this->pdo = new PDO($config['dsn'], $config['username'], $config['password']);
        } catch (PDOException $e) {
            die('Database connection cannot be established');
        }
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->pdo;
    }
    
}
