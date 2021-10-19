<?php
$host_name = 'localhost';
$database = 'zutrittskontrolle';
$user_name = 'root';
$password = 'test';
 $pdo = null;


//$key=random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES);
//$nonce=random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);

//echo base64_encode($nonce);
//file_put_contents("key.key",$key);
//file_put_contents("nonce.key",$nonce);

$key=base64_decode(file_get_contents("C:/Users/chrcu/Desktop/key.key"));


?>
