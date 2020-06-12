<?php

namespace App\Model;
   
abstract class Conexao
{
   public static $Host = HOST;
   public static $User = USER;
   public static $Pass = PASS;
   public static $Dbname = DBNAME;
 
   private static $Connect = null;

   private static function conectar(){
        try{
          if(self::$Connect == null){
            self::$Connect =  new \PDO('mysql:host='.self::$Host.';dbname='.self::$Dbname, self::$User, self::$Pass);
            self::$Connect->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            self::$Connect->exec('set names utf8');
          }
        } catch (\PDOException $e){
            echo "Erro: " . $e->getMessage();
        }
        return self::$Connect;
    }
    public function getConn(){
        return self::Conectar();
     }
}