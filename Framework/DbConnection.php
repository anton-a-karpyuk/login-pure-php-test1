<?php


namespace TestApp;

use PDO;

class DbConnection
{
    private static $instance = null;

    /**
     * @var PDO
     */
    private $connection = null;

    private $host = 'localhost';
    private $user = '';
    private $database = '';
    private $password = '';

    /**
     * DbConnection constructor.
     */
    public function __construct()
    {

    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new DbConnection();
        }
        return self::$instance;
    }

    /**
     * @param $host
     * @param $database
     * @param $user
     * @param $password
     * @return DbConnection
     */
    public function connect($host, $database, $user, $password)
    {
        $this->host = $host;
        $this->database = $database;
        $this->user = $user;
        $this->password = $password;
        $this->connection = new PDO("mysql:host={$this->host};dbname={$this->database}", $this->user, $this->password,
            [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        return $this;
    }

    /**
     * @return PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }
}