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
            $sql = "UPDATE STORAGE_PROVIDER SET storage=$1, endpoint=$2, login=$3, password=$4";
            $result = pg_query_params($this->connection, $sql, array($storage, $endpoint, $login, $password));
            $affectRows = pg_affected_rows($result);

            if ($affectRows > 0) {
                $this->message_front(200, "Provedor de armazenamento externo alterado com sucesso!");
            } else {
                $this->message_front(400, "Falha ao tentar alterar o provedor de armazenamento externo!");
            }

        } else {

            $sql = "INSERT INTO STORAGE_PROVIDER(storage, endpoint, login, password) VALUES
                 ($1, $2, $3, $4)";
            $result = pg_query_params($this->connection, $sql, array($storage, $endpoint, $login, $password));
            $affectRows = pg_affected_rows($result);

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
        $query = pg_query($this->connection, $sql);
        $result = pg_num_rows($query);

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
