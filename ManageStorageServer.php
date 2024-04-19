<?php

namespace manageStorage;
class ManageStorageServer
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function setStorage($storage, $endpoint, $login, $password)
    {
        $listOfStorage = $this->alterStorage();

        if ($listOfStorage > 0) {
            $sql = "UPDATE STORAGE_PROVIDER SET storage= :storage, endpoint= :endpoint, login= :login, password= :password";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([
                ':storage'  => $storage,
                ':endpoint' => $endpoint,
                ':login'    => $login,
                ':password' => $password
            ]);
            $affectRows = $stmt->rowCount();

            if ($affectRows > 0) {
                $this->message_front(200, "Provedor de armazenamento externo alterado com sucesso!");
            } else {
                $this->message_front(400, "Falha ao tentar alterar o provedor de armazenamento externo!");
            }

        } else {

            $sql = "INSERT INTO STORAGE_PROVIDER(storage, endpoint, login, password) VALUES
                 (:storage, :endpoint, :login, :password)";
            
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([
                ':storage'  => $storage,
                ':endpoint' => $endpoint,
                ':login'    => $login,
                ':password' => $password
            ]);
            $affectRows = $stmt->rowCount();

            if ($affectRows > 0) {
                $this->message_front(200, "Provedor de armazenamento externo cadastrado com sucesso!");
            } else {
                $this->message_front(400, "Falha ao tentar cadastrar o provedor de armazenamento externo!");
            }
        }
    }

    public function alterStorage()
    {
        $sql = "SELECT STORAGE FROM STORAGE_PROVIDER";
        $stmt = $this->connection->query($sql);
        $result = $stmt->rowCount();

        return $result;
    }

    public function message_front($code, $message)
    {
        http_response_code($code);
        echo json_encode([
            "message" => $message
        ]);
    }
}
