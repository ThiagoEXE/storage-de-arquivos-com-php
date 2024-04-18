<?php
namespace db;
require 'vendor/autoload.php';
use Dotenv\Dotenv;

class DataBaseConnection
{
    private $conexao;

    public function __construct()
    {
        $dotenv = Dotenv::createUnsafeImmutable(__DIR__);
        $dotenv->load();
        $host = getenv('PG_HOST');
        $port = getenv('PG_PORT');
        $user = getenv('PG_USER');
        $password = getenv('PG_PASS');
        $dbname = getenv('PG_NAME');
        $keepalive_idle = 300;
        /*desabilita a exibição de erros em produção, remover quando estiver no desenvolvimento*/
       // error_reporting(E_ERROR | E_PARSE);
      //  ini_set('display_errors', 'Off');

        $this->conexao =  pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password keepalives_idle=$keepalive_idle");

        if (!$this->conexao) {
            die("Erro ao conectar na base de dados: " . pg_last_error($this->conexao));
        }
    }

    public function getConexao()
    {

        return $this->conexao;
    }

    public function fecharConexao()
    {
        if ($this->conexao) {
            pg_close($this->conexao);
        }
    }
}
