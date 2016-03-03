<?php

namespace priscille_q\mvc_app\Model;
use priscille_q\mvc_app\Model\DB;

Class JobRoleDB extends DB
{
	private static $instance;

	protected function __construct()
	{
		parent::__construct();
	}

	public static function getJobRoleDB()
	{
		if (is_null(self::$instance))
		{
			self::$instance = new JobRoleDB();
		}
		return self::$instance;
	}

	public function getJobRoleList()
	{
		$query = 'SELECT jobRoleId, role FROM technicalTest.jobRole';
		$statement = $this->pdo->query($query);
		return $statement->fetchAll(\PDO::FETCH_CLASS);
	}
}
