<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use League\Flysystem\Filesystem;
use League\Flysystem\AwsS3v3\AwsS3Adapter;

class UploadController extends Controller
{
    public function actionUpload()
    {
        $file = UploadedFile::getInstanceByName('image');
        if ($file) {
            $s3 = Yii::$app->storage->s3;
            $path = 'images/' . uniqid() . '.' . $file->extension;
            $s3->put($path, fopen($file->tempName, 'r+'), [
                'visibility' => 'public',
                'mimetype' => $file->type,
            ]);
            return ['path' => $path];
        }
        Yii::$app->response->statusCode = 400;
        return ['error' => 'No file uploaded'];
    }
}
