<?php
include('SaveFiles.php');
include('DataBaseConnection.php');
include('ManageStorageServer.php');
use save\SaveFiles;
use manageStorage\ManageStorageServer;
use db\DataBaseConnection;

class ManageRequest
{
    public function msg_error($code, $message)
    {
        http_response_code($code);
        echo json_encode([
            "message" => $message
        ]);
    }
    public function getRequest()
    {
        
        
        if (isset($_POST['storage'])) {
            
            isset($_POST['storage']) ? $storage = $_POST['storage'] : $storage = null;
            isset($_POST['endpoint']) ? $endpoint = $_POST['endpoint'] : $endpoint = null;
            isset($_POST['login']) ? $login = $_POST['login'] : $login = null;
            isset($_POST['password']) ? $password = $_POST['password'] : $password = null;
            
            
            if ($endpoint !== null && $login !== null && $password !== null && $storage !== null) {
                //abre a conexao 
                $objConn = new DataBaseConnection();
                $connection = $objConn->getConexao();
              
                $manageStorage = new ManageStorageServer($connection);
                $manageStorage->setStorage($storage, $endpoint, $login, $password);
                $objConn->fecharConexao();
            
               
            } else {
                $this->msg_error(400, "Parâmetros incorretos");
            }
        } else {
            $this->msg_error(400, "Requisição inválida");
        }
    }
}

$object = new ManageRequest();
$object->getRequest();
