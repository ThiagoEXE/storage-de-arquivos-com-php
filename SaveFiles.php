<?php
namespace save;
require 'StorageConnection.php';
require 'MinioStorage.php';
use storage\StorageConnection;
use minio\MinioStorage;
class SaveFiles
{


    public function save()
    {
        $bucketName = 'docker-compose-test';
        $objectKey = 'teste.pdf';
        $localFilePath = __DIR__ . '/file.pdf';
     //   echo $localFilePath;
        $storageConn = new StorageConnection();
        $connMinio = $storageConn->connectionInMinio();

        $saveInMinio = new MinioStorage($connMinio, $bucketName, $objectKey);
        $saveInMinio->setObjectInMinio($localFilePath);
        $saveInMinio->getObjectInMinio();
    }
}

//$file = new SaveFiles();
//$file->save();