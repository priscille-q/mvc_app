<?php

namespace priscille_q\mvc_app\Model;
use priscille_q\mvc_app\Model\JobRole;
use priscille_q\mvc_app\Model\PersonDB;

class Person
{
	private $id;
	private $firstName;
	private $lastName;
	private $email;
	private $jobRole;
	private $personeDB

	public function __construct($id, $firstName, $lastName, $email, JobRole $jobRole)
	{
		$this->id = $id;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->email = $email;
		$this->jobRole = $jobRole;
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
}
