<?php

namespace priscille_q\mvc_app\Model;

class DB
{
	protected $pdo;
	const HOST_NAME ='localhost';
	const BASE ='technicalTest';
	const USER ='root';
	const PWD ='';
	protected function __construct()
	{
		try{
            $this->pdo = new \PDO('mysql:host='. self::HOST_NAME .
                                 ';dbname='. self::BASE .';charset=utf8;',
                                 self::USER, self::PWD,
                                 array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $e) {
            echo 'Connection failed: '.$e->getMessage().' N° :'.$e->getCode()."\n";
            exit();
        }
	}
}
