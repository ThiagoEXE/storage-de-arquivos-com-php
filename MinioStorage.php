<?php

namespace minio;
use Aws\Exception\AwsException;
use Aws\S3\S3Client;

class MinioStorage
{
    private S3Client $minio;
    private $bucketName;
    private $objectKey;

    public function __construct(S3Client $minio, $bucketName, $objectKey) {
        $this->minio = $minio;
        $this->bucketName = $bucketName;
        $this->objectKey = $objectKey;
    }

    public function setObjectInMinio($localFilePath) {

        try{

            $insert = $this->minio->putObject([
                'Bucket' => $this->bucketName,
                'Key' => $this->objectKey,
                'SourceFile' => $localFilePath,
            ]);

            echo "Arquivo PDF enviado com sucesso para o MinIO! ETag: " . $insert['ETag'];
        }catch(AwsException $e){
            echo "Erro ao enviar o arquivo!";
        }
    }

    public function getObjectInMinio()
    {
        $retrive = $this->minio->getObject([
            'Bucket' => $this->bucketName,
            'Key' => $this->objectKey,
            'SaveAs' => 'arquivo-baixado.pdf'
          ]);
    }
}
