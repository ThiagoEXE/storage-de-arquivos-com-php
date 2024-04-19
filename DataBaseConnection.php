<?php

namespace db;

require 'vendor/autoload.php';

use Dotenv\Dotenv;
use PDO;
use PDOException;

class DataBaseConnection
{
    private $pdoConnection;
    private $host;
    private $port;
    private $user;
    private $password;
    private $dbname;
    private $database_type;
    private $dns;

    public function __construct()
    {
        $dotenv = Dotenv::createUnsafeImmutable(__DIR__);
        $dotenv->load();
        $this->host = getenv('DB_HOST');
        $this->port = getenv('DB_PORT');
        $this->user = getenv('DB_USER');
        $this->password = getenv('DB_PASS');
        $this->dbname = getenv('DB_NAME');
        $this->database_type = strtolower(trim(getenv('DB_TYPE')));
        $this->selectDatabaseConnection();
    }

    public function selectDatabaseConnection()
    {

        switch ($this->database_type) {
            case 'mysql':
                $this->dns = "mysql:host=$this->host;port=$this->port;dbname=$this->dbname;charset=utf8";
                break;
            case 'postgresql':
                $this->dns = "pgsql:host=$this->host;port=$this->port;dbname=$this->dbname;charset=utf8";
                break;
            case 'oracle':
                $this->dns = "oci:dbname=yoursid";
                break;
            default:
                $this->dns = "pgsql:host=$this->host;dbname=$this->dbname";
        }
    }
    public function getConexao()
    {

        try {
            $this->pdoConnection = new PDO($this->dns, $this->user, $this->password);
        } catch (PDOException $e) {
            die('Falha na conexão: ' . $e->getMessage());
        }
        return $this->pdoConnection;
    }

    public function fecharConexao()
    {
        if ($this->pdoConnection) {
            $this->pdoConnection = null;
            //echo "Fechou a conexao com o postgres";          
        }
    }
}
