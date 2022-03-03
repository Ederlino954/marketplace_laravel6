<?php
namespace App\Classes;
class Enc{
    public function encriptar($valor){
        return bin2hex( openssl_encrypt($valor, 'aes-256-cbc', 'S0Gus7D1zjpgUlB4e9XIqNQZBgl1gecE', OPENSSL_RAW_DATA, 'r4r2Ka4rnY3KGIrB') );
    }
    public static function desencriptar($valor_encriptado){

        // verificar se a hash é válida
        if (strlen($valor_encriptado)%2 != 0) {
            return null ;
        }

        return openssl_decrypt( hex2bin($valor_encriptado), 'aes-256-cbc' , 'S0Gus7D1zjpgUlB4e9XIqNQZBgl1gecE', OPENSSL_RAW_DATA, 'r4r2Ka4rnY3KGIrB' );
    }
}
