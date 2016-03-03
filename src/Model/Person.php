<?php

namespace priscille_q\mvc_app\Model;

class Person
{
	private $id;
	private $firstName;
	private $lastName;
	private $email;
	private $jobRole;

	public function __construct($id, $firstName, $lastName, $email, JobRole $jobRole)
	{
		$this->id = $id;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->email = $email;
		$this->jobRole = $jobRole;
	}

	public function SetDbManager()
	{

	}

	public function save()
	{

	}
}
