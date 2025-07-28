<?php

/**
 * This file is subject to the terms and conditions defined in
 * file 'LICENSE.txt', which is part of this source code package.
 */

class Database
{
    protected $host;
    protected $database;
    protected $username;
    protected $password;
    protected $character_set;
    protected $options;

    public function __construct($config = null)
    {
        // Load configuration from config file or use provided config
        if ($config === null) {
            $config = require_once dirname(__DIR__) . '/config/database.php';
        }

        $this->host = $config['host'] ?? 'localhost';
        $this->database = $config['database'] ?? '';
        $this->username = $config['username'] ?? '';
        $this->password = $config['password'] ?? '';
        $this->character_set = $config['charset'] ?? 'utf8mb4';
        
        $this->options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];
    }

    public function getConnection()
    {
        static $connection = null;
        if (is_null($connection)) {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->database . ';charset=' . $this->character_set;
            try {
                $connection = new \PDO($dsn, $this->username, $this->password, $this->options);
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
        }
        return $connection;
    }

    // Legacy methods for backward compatibility
    public function dbadmin()
    {
        return $this->getConnection();
    }

    public function dbwr()
    {
        return $this->getConnection();
    }

    public function dbsecure()
    {
        return $this->getConnection();
    }
}