<?php
$host_name = 'localhost';
$database = 'zutrittskontrolle';
$user_name = 'root';
$password = 'test';
 $pdo = null;

//$key = "@�{�+�E�ۡ��/6�pD��+N�zL��";
//$nonce="s3�'���i ���i!u��U����";

//$key=random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES);
//$nonce=random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);

//echo base64_encode($nonce);
//file_put_contents("key.key",$key);
//file_put_contents("nonce.key",$nonce);
//var_dump(scandir(""));

$key=base64_decode(file_get_contents("C:/Users/chrcu/OneDrive - Cürten & Paffrath Informationstechnik UG (haftungsbeschränkt)/Dokumente - cpi/DLRG Remscheid/QR_Reader-repository/Version 1/key.key"));


?>
