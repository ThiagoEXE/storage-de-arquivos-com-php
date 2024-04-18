<?php
namespace storage;
require 'vendor/autoload.php';
use Aws\S3\S3Client;

class StorageConnection
{
    public function connectionInMinio()
    {
        date_default_timezone_set('America/Sao_Paulo');
        $s3 = new S3Client([
            'version' => 'latest',
            'region'  => 'us-east-1',
            'endpoint' => 'http://...',
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key'    => '',
                'secret' => ''
            ],
        ]);

        return $s3;
    }
    public function connectionInAmazonS3()
    {
        date_default_timezone_set('America/Sao_Paulo');
        $s3 = new S3Client([
            'version' => 'latest',
            'region'  => 'us-east-1',
            'endpoint' => '',
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key'    => '',
                'secret' => ''
            ],
        ]);

        return $s3;
    }
   
}


