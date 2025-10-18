<?php
$data = htmlentities("$2y$10\$qr9Cd2EmSpP/iDKWl0w2DeyXpgKgPrS2G.Um4MGk5FDvP43KSquYC");

$is_authenticated = password_verify("a", $data);
print_r($is_authenticated);

if ($is_authenticated != 1) {
    echo "dalam cek";
}else{
    echo "dalam else";
    
}