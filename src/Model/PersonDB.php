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

	public function save($id, $firstName, $lastName, $email, $jobRole)
	{
		if (is_null($this->saveStatement))
		{
			$this->prepartSaveStatment();
		}
		$this->saveStatement->bindParam(':personId', $id);
		$this->saveStatement->bindParam(':firstName', $firstName);
		$this->saveStatement->bindParam(':lastName', $lastName);
		$this->saveStatement->bindParam(':email', $email);
		$this->saveStatement->bindParam(':jobRoleId', $jobRole);
		$this->saveStatement->execute();
	}

	public function delete($id)
	{
		if (is_null($this->deleteStatement))
		{
			$this->prepartDeleteStatment();
		}
		if (!preg_match('/^[0-9]$/', $id))
		{
			return;
		}
		$this->deleteStatement->bindParam(':id', $id);
		$this->deleteStatement->execute();
	}

	protected function prepartSaveStatment()
	{
		$this->pdo->prepare(
		'REPLACE INTO technicalTest.person
		(
			personId,
			firstName,
			lastName,
			email,
			jobRoleId,
		)
		values
		(
			:personId,
			:firstName,
			:lastName,
			:email,
			:jobRoleId,
		)'
	);
	}

	protected function prepartDeleteStatment()
	{
		$this->pdo->prepare(
		'DELETE FROM technicalTest.person
		WHERE personId = :id'
	);
	}
}
