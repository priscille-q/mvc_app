<?php

namespace priscille_q\mvc_app\Model;
use priscille_q\mvc_app\Model\JobRole;
use priscille_q\mvc_app\Model\PersonDB;

use priscille_q\mvc_app\Exception\PersonOvermuchException;

class Person
{
	const MAXIMUM_PERSON = 10;

	private $id;
	private $firstName;
	private $lastName;
	private $email;
	private $jobRole;
	private $personeDB;
	private static $numberPerson = 0;

	public function __construct($id, $firstName, $lastName, $email, JobRole $jobRole)
	{
		$this->id = $id;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->email = $email;
		$this->jobRole = $jobRole;
	}

	public function createPerson($id, $firstName, $lastName, $email, JobRole $jobRole)
	{
		if ((self::MAXIMUM_PERSON) <= (self::$numberPerson + 1))
		{
			throw new PersonOvermuchException('Can not exceed ' . self::MAXIMUM_PERSON .
				' instance of Person.');
		}
		self::$numberPerson++;

		$newPerson = new Person($id, $firstName, $lastName, $email, $jobRole);
		return $newPerson;
	}

	public function SetPersonDb(PersonDB $personDB)
	{
		$this->personDB = $personDB;
	}

	public function save()
	{
		$this->personDB->save($this->id, $this->firstName, $this->lastName,
			$this->email, $this->jobRole);
	}

	public function __destruct()
	{
		self::$numberPerson--;
	}
}
