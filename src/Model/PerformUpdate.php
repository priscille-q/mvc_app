<?php

namespace priscille_q\mvc_app\Model;

use priscille_q\mvc_app\Model\PerformInterface;
use priscille_q\mvc_app\Model\JobRole;
use priscille_q\mvc_app\Model\Person;
use priscille_q\mvc_app\Model\PersonDB;

use priscille_q\mvc_app\Exception\JobRoleOvermuchException;
use priscille_q\mvc_app\Exception\PersonOvermuchException;

Class PerformUpdate implements PerformInterface
{
	protected $people;
	private $error = 0;
	private $jobRoleError = 0;
	private $toBeDelete = array();
	private $personList = array();

	public function __construct($people = array())
	{

		foreach ($people as $id => $someone)
		{
			if (isset($someone['delete']))
			{
				$this->toBeDelete[] = $id;
				continue;
			}
			if (!empty($someone['firstName']) && !empty($someone['lastName']) &&
				!empty($someone['email']) && !empty($someone['jobRoleId']))
			{
				try
				{
					$jobRole = JobRole::createJobRole($someone['jobRoleId']);
				}
				catch (jobRoleOvermuchException $e)
				{
					$this->error++;
					$this->jobRoleError++;

					break;
				}
				try
				{
					$person = Person::createPerson($id, htmlentities($someone['firstName']), htmlentities($someone['lastName']),
						htmlentities($someone['email']), $jobRole);
				}
				catch (PersonOvermuchException $e)
				{
					echo $e->getMessage() .'<br/>';
					break;
				}
				$this->personList[] = $person;
			}
			elseif (empty($someone['firstName']) && empty($someone['lastName']) &&
				empty($someone['email']))
			{
				//nothing to do
			}
			else
			{
				//Data are missing
				$this->error++;
				break;
			}
		}

	}

	public function execute()
	{
		if ((0 >= $this->jobRoleError) && (0 >= $this->error))
		{
			$personDb = PersonDB::getPersonDB();
			foreach ($this->toBeDelete as $id)
			{
				$personDb->delete($id);
			}
			foreach ($this->personList as $person)
			{
				$person->SetPersonDb($personDb);
				$person->save();
			}
			return true;
		}
		else
		{
			if (0 < $this->jobRoleError)
			{
				echo 'A job role can not be use more than ' . JobRole::MAXIMUM_BY_JOB_ROLE . ' .<br/>';
			}

			if (0 < $this->error)
			{
				echo 'Incorrect form.<br/>';
			}
		}
		return false;
	}
}
