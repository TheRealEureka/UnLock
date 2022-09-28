<?php

namespace Unlock\Utility;

class ConnectionFactory
{
    private static array $tab;
    private static \PDO $conn;


    public static function setConfig( $file ) : void
    {
        self::$tab = parse_ini_file($file);
    }
    public static function makeConnection(): \PDO
    {
        if(!isset(self::$conn))
        {
            self::$conn = new \PDO(self::$tab["Driver"] . ':host='.self::$tab["Host"].';dbname='.self::$tab["Dbname"].';port='.self::$tab["Port"],self::$tab["User"] , self::$tab["Pswd"]);

        }
        return self::$conn;

    }


}