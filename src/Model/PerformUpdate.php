<?php

namespace priscille_q\mvc_app\Model;

use priscille_q\mvc_app\Model\PerformInterface;
use priscille_q\mvc_app\Model\JobRole;

use priscille_q\mvc_app\Exception\JobRoleOvermuchException;

Class PerformUpdate implements PerformInterface
{
	protected $people;
	private $error = 0;
	private $jobRoleError = 0;
	private $toBeDelete = array();

	public function __construct($people = array())
	{
		$personList = array();
		foreach ($people as $id => $someone)
		{

			if (isset($someone['delete']))
			{
				$this->toBeDelete[] = $id;
				continue;
			}
			if (!empty($someone['firstName']) && !empty($someone['lastName']) &&
				!empty($someone['email']) && !empty($someone['jobRole']))
			{
				try
				{
					$jobRole = JobRole::createJobRole($someone['jobRole']);
				}
				catch (JobRoleOvermuchException $e)
				{
					$this->error++;
					$this->jobRoleError++;
					break;
				}
				try
				{
					$person = new Person($id, htmlentities($someone['firstName']), htmlentities($someone['lastName']),
						htmlentities($someone['email']), $jobRole);
				}
				catch (Exception $e)
				{
					$this->error++;
					break;
				}

				$personList[] = $person;
			}
			elseif (empty($someone['firstName']) && empty($someone['lastName']) &&
				empty($someone['email']) && empty($someone['jobRole']))
			{
				//nothing to do
			}
			else
			{
				//Data are missing
				$this->error++;
				break;
			}
			var_dump($someone);
		}

	}

	public function execute()
	{
		if ((0 >= $this->jobRoleError) && (0 >= $this->error))
		{
			//traitement des donner
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
	}
}
