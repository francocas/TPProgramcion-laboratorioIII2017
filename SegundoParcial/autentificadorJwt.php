<?php

    
    require_once './vendor/autoload.php';
    use \Firebase\JWT\JWT;

    class autentificadorJwt{

        private static $claveSectreta = 'qWerTy@';
        private static $tipoEncriptacion = 'HS256';

        public static function CrearToken($datos, $tiempoEnSegs){

            $ahora = time();
            $payLoad = array(
                'iat' => $ahora,
                'exp' => $ahora + $tiempoEnSegs,
                'data' => $datos,
                'app' => 'apiRest JWT'
                );

            $token = JWT::encode(
                $payLoad,
                self::$claveSectreta,
                self::$tipoEncriptacion
                ); 

            return $token;

        }

        public static function VerificarToken($token){

            $decodificado = JWT::decode(
                $token,
                self::$claveSectreta,
                array(self::$tipoEncriptacion,'HS384')
                );
                if($decodificado->data== NULL)
                {
                    return false;
                }else{
                    return true;
                }

        }

    }


?>