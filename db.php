<?php
//C9.io: https://a-d-m-i-n-maitret.c9users.io/
/*
$db_server_main_db = "localhost";
$db_username_main_db = 'maitret';
$db_password_main_db = '';
$db_name_main_db = 'a-d-m-i-n';
*/
//BackAnd.com: demoadmin; es solo un demo, please no borrar esta base de datos! :@ 
$db_server_main_db = "bk-prod-us1.cd2junihlkms.us-east-1.rds.amazonaws.com";
$db_username_main_db = 'deegp1cpl55cfd9';
$db_password_main_db = 'gwyi8N2fAK3OpoF7OhnlS9';
$db_name_main_db = 'backanddemoadminomjmim55';

$db_name_sys_db = $db_name_main_db;

$server = $_SERVER["SERVER_NAME"];

$mysqli = new mysqli($db_server_main_db, $db_username_main_db, $db_password_main_db, $db_name_main_db);
if ($mysqli -> connect_errno) {
echo "Lo sentimos pero se presento un error al conectarse en la base de datos MySQLi '".$db_server_main_db."' (" . $mysqli -> connect_errno . ") " . $mysqli -> connect_error;
}
$mysqli_sys = $mysqli;

$email_admin = "maitret@myhostmx.com"; 
$email_debug = "maitret@myhostmx.com"; 
$url_adminer = "//".$server."/adminer.php?server=".$db_server_main_db."&username=".$db_username_main_db."&db=".$db_name_main_db."";
$url_gae = ""; //TODO: Pendiente subir a GoogleAppEngine script para upload de imagenes a Google Photos via remota (es para ahorrar espacio en disco) :D
$aws_s3_key = "";
$aws_s3_secret = "";
$aws_s3_bucket = "";
$aws_s3_region = "us-west-2";
/*
$email_admin = $GLOBALS['email_admin']; $email_debug = $GLOBALS['email_debug']; 
$aws_s3_key = $GLOBALS['aws_s3_key']; $aws_s3_secret = $GLOBALS['aws_s3_secret']; 
$aws_s3_bucket = $GLOBALS['aws_s3_bucket']; $aws_s3_region = $GLOBALS['aws_s3_region'];
$url_gae = $GLOBALS['url_gae']; 
*/
$google_maps_key = "AIzaSyAlDumcJn9Tok0-rDp9iPpKr3HPUMs6Vjs";
$firebase_app = "adminpanel-demo";
$firebase_apiKey = "AIzaSyAlDumcJn9Tok0-rDp9iPpKr3HPUMs6Vjs"; /* Es la misma de gmaps pero puede variar, asi que no mamar! */
$firebase_messagingSenderId = "405953922342";
$firebase_authDomain = $firebase_app.".firebaseapp.com";
$firebase_databaseURL = "https://".$firebase_app.".firebaseio.com";
$firebase_storageBucket = $firebase_app.".appspot.com";
/*
apiKey: "AIzaSyAlDumcJn9Tok0-rDp9iPpKr3HPUMs6Vjs",
authDomain: "adminpanel-demo.firebaseapp.com",
databaseURL: "https://adminpanel-demo.firebaseio.com",
storageBucket: "adminpanel-demo.appspot.com",
messagingSenderId: "405953922342"
*/

/* Mas info en:
https://googlecloudplatform.github.io/google-cloud-php/#/docs/v0.20.1/guides/authentication (On Your Own Server)
https://googlecloudplatform.github.io/google-cloud-php/#/docs/v0.20.1/servicebuilder */
$google_gcloud_keyFile = '{
  "type": "service_account",
  "project_id": "adminpanel-demo",
  "private_key_id": "50a9acb4fef3ac6ff9e6bb4917be8b420e7a1408",
  "private_key": "-----BEGIN PRIVATE KEY-----\nMIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCkUK4FbI7WAq/C\nX8qhTbDe0TeUmu5PCXNk56LQPs3HcLFyvauUgDLOujrbzaG174e2+s0X+Qf8IIpS\n/R2YBXjGavyHHKxMP0brt/Miok12UQD+XACFJo3lJgxlX52aGCTcIBR2HzpJGzQ9\nqPb5UWkNh9hMsyh0bHazSqHfoafMTalANcUCvEg/5CiVxeIRMKL4w71gDIDcA1Q+\nYCa95u64aNA2s6Q0Ugxl7Wmv+G+Jr7rRRvwstKV4VovillvLF25kIRSCn9Bq6Wwq\nfeZObS5oL6NpmDvIhKECSbCIs9CnoR2iA6qXa8cTwgCY+XVyTwcAiU8YywJbAD9l\nHFHt5KoZAgMBAAECggEAYRyhzOjc/lT2JY3Rx0WQbBAApl5uy92NCqzwB92mZuIO\nrf61Qn4GCTH9iVzd3xYjApz1y95NvtBIkEWyUN+jArnGZ+AlYKbhNn0wQF7mIzA6\nwxoC4K7pm+3B08QP9DuixUpcbXeFTiG63VpYJP/dc7a+uo4EMdLM0KgiRXZYIqEt\nGDjQaRLg6zRXZG5nK7cGl7P+tuRtrHt0FtJ1pciPHEq//FfVR5F0nwAU8mlM0ImD\nH6bOkVpOK1DX27MZG3iAFJTUNq3UZlclU4bTgVS9tc46at1FQrsj6Es1Sde7pPJD\nHNxP+EbeXKnpZCs3z71OHv5c12H7fiD3IWlVphhCAQKBgQDQk5z53iWTnYDJZaPH\nTz3W+ASY2bIgM9fflUsQSHI5LMalzA69dpJKw7VuL/4GXjVMQoCLpMhTbjNuTMnf\nPVFy4jtW6mRo+1J59UDVjpKNf6d1UHAJAkFqudfE02rLN+bp2X8EUt5AFVFhv5HX\nmH0n6ZdyTImyswGtsVUlUQmjwQKBgQDJrMoECydsi6uMcZmmhlgQNpUhgU1z2d8I\n3DIKShV+3FP0lTJDvs7scH3sRMowAAGijxsoIz5kVjei7oynmnWVKTvLs8ePubJZ\nx1ZVMC9XH+EKlDmnHm27fdkJNkKN16Pjgwth2boaaXadZQemIfXJntfSnwPpPlxY\n9xCTy4m8WQKBgGRFMofkxcfLRiiL1kpwy9fWb89TiJB2m+b+jJGNYmweHHmEOenX\nYMjUgRoxtDs3ewPoTIfVdgC1z7/M5peNkORb4g8Mq6zUdXfv8XU5Dzc7ETQSsWmD\nThOSuCoFQSfk/fuZ9bgMZpAEL5WAVQqCYliXsZjfNqtT5xCrWbWQ2cOBAoGAfHQ3\n2lTzyEVM4Qd9lUkUcTTtxNZhcJvDyljwPG9JYpce7DFh6nKGiVxGKRauWv62A5Yi\nYRuWth6KiO6DOC7WXu0qLGPORACJcmPUABATNsXCf1/HUD0z5F8eH1QvsA6h4ZWN\n4Z2V/hSVET42gSw13G08rIpaxIYqQPB+d2ZEokkCgYANJDVF5QgQpIkeli+EOhZ5\nGDgXzplJk9XlvymnvOL1My4wuQST8SPswr5yvMhwZAhmyhSibYBW0jV9maTEan7o\nHUY46oNLMGTUmLlZM3E9nlqRzvs8DvLOjJv6ay1pynH3dYLY1XwEnbuK74/YCzKv\nmHNdjJUmrIPBKxcFiz1Wzw==\n-----END PRIVATE KEY-----\n",
  "client_email": "adminpanel-demo@appspot.gserviceaccount.com",
  "client_id": "109807623909538311668",
  "auth_uri": "https://accounts.google.com/o/oauth2/auth",
  "token_uri": "https://accounts.google.com/o/oauth2/token",
  "auth_provider_x509_cert_url": "https://www.googleapis.com/oauth2/v1/certs",
  "client_x509_cert_url": "https://www.googleapis.com/robot/v1/metadata/x509/adminpanel-demo%40appspot.gserviceaccount.com"
}';
$google_gcloud_projectId = "405953922342";
$google_gcloud_bucketName = "adminpanel-demo.appspot.com";

$smart_style = "5"; /* Existen varias opciones, del 1 al 6 creo :p */

?>