<?php
// https://googlecloudplatform.github.io/google-cloud-php/#/docs/v0.20.1/servicebuilder
require __DIR__ . '/vendor/autoload.php';
use Google\Cloud\ServiceBuilder;

include_once "../../funciones.php";
$google_gcloud_keyFile_array = json_decode($google_gcloud_keyFile, true);
if(is_array($google_gcloud_keyFile_array) && $google_gcloud_projectId != "" && $google_gcloud_bucketName != ""){
//json_decode(file_get_contents($path), true);
$gcloud = new ServiceBuilder([
'keyFile' => $google_gcloud_keyFile_array,
//'keyFilePath' => __DIR__.'/keyFile.json',
'projectId' => $google_gcloud_projectId
]);
$storage = $gcloud->storage();

$bucketName = $google_gcloud_bucketName;
//$bucket = $storage->createBucket($bucketName);
//echo 'Bucket ' . $bucket->name() . ' created.'; 

$bucket = $storage->bucket($bucketName);

$options = [
'resumable' => true,
'name' => 'test.jpg',
'predefinedAcl' => 'publicRead',
'metadata' => [
'contentLanguage' => 'es'
]];
$object = $bucket->upload(
fopen(__DIR__ . '/test.jpg', 'r'),
$options
);

$objects = $bucket->objects([
'prefix' => '',
'fields' => 'items/name,nextPageToken'
]);
$url_gae_storage = "https://storage.googleapis.com/".$bucketName;
foreach ($objects as $object_) {
//echo $url_gae_storage."/".$object->name();
$object = $bucket->object($object_->name());
$info = $object->info();
echo "objecto: " . json_encode($info) . "<br>identity: " . $object->identity()['object'] . "<hr>";
}
}
?>