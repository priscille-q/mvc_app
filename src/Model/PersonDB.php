<?php

namespace priscille_q\mvc_app\Model;
use priscille_q\mvc_app\Model\DB;

class PersonDB extends DB
{
	private $saveStatement;
	private $deleteStatement;

	private static $instance;

	protected function __construct()
	{
		parent::__construct();
	}

	public static function getPersonDB()
	{
		if (is_null(self::$instance))
		{
			self::$instance = new PersonDB();
		}
		return self::$instance;
	}

	public function getPersonList()
	{
		$query = 'SELECT personId, firstName, lastName, email, jobRoleId
			FROM technicalTest.person';
		$statement = $this->pdo->query($query);
		$people = array();
		foreach ($statement->fetchAll() as $person)
		{
			$people[$person['personId']]['firstName'] = $person['firstName'];
			$people[$person['personId']]['lastName'] = $person['lastName'];
			$people[$person['personId']]['email'] = $person['email'];
			$people[$person['personId']]['jobRoleId'] = $person['jobRoleId'];
		}
		return $people;
	}

	public function save($id, $firstName, $lastName, $email, $jobRole)
	{
		if (is_null($this->saveStatement))
		{
			$this->prepartSaveStatment();
		}
		$this->saveStatement->bindParam(':personId', $id, \PDO::PARAM_INT);
		$this->saveStatement->bindParam(':firstName', $firstName, \PDO::PARAM_STR);
		$this->saveStatement->bindParam(':lastName', $lastName, \PDO::PARAM_STR);
		$this->saveStatement->bindParam(':email', $email, \PDO::PARAM_STR);
		$this->saveStatement->bindParam(':jobRoleId', $jobRole->getJobRoleId(), \PDO::PARAM_INT);
		$this->saveStatement->execute();
	}

	public function delete($id)
	{
		if (is_null($this->deleteStatement))
		{
			$this->prepartDeleteStatment();
		}
		if (!preg_match('/^[0-9]{1,}$/', $id))
		{
			return;
		}
		$this->deleteStatement->bindParam(':id', $id, \PDO::PARAM_INT);
		$this->deleteStatement->execute();
	}

	protected function prepartSaveStatment()
	{
		$this->saveStatement = $this->pdo->prepare(
		'REPLACE INTO technicalTest.person
		(
			personId,
			firstName,
			lastName,
			email,
			jobRoleId
		)
		values
		(
			:personId,
			:firstName,
			:lastName,
			:email,
			:jobRoleId
		)'
	);
	}

	protected function prepartDeleteStatment()
	{
		$this->deleteStatement = $this->pdo->prepare(
		'DELETE FROM technicalTest.person
		WHERE personId = :id'
		);
	}
}
