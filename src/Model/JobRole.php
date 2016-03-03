<?php

namespace priscille_q\mvc_app\Model;

use priscille_q\mvc_app\Exception\JobRoleOvermuchException;

Class JobRole
{
	const MAXIMUM_BY_JOB_ROLE = 4;
	protected $jobRoleId;
	protected $jobRoleName;
	protected static $numberUsageOfRole = array();

	private function __construct($jobRoleId, $jobRoleName)
	{
		$this->jobRoleId = $jobRoleId;
		$this->jobRoleName = $jobRoleName;
	}

	public static function createJobRole($jobRoleId, $jobRoleName)
	{
		if (isset(self::$numberUsageOfRole[$jobRoleId]))
		{
			if ((self::MAXIMUM_BY_JOB_ROLE) <= self::$numberUsageOfRole[$jobRoleId])
			{
				throw new JobRoleOvermuchException('The job role ' . $jobRoleName .
				' can not exceed ' . self::MAXIMUM_BY_JOB_ROLE . ' instance.');
			}
			self::$numberUsageOfRole[$jobRoleId]++;
		}
		else
		{
			self::$numberUsageOfRole[$jobRoleId] = 1;
		}
		$newJobRole = new JobRole($jobRoleId, $jobRoleName);
		return $newJobRole;
	}

	function __destruct()
	{
		self::$numberUsageOfRole[$this->jobRoleName]--;
	}

	public function getJobRoleName()
	{
		return $this->jobRoleName;
	}

	public function getJobRoleId()
	{
		return $this->jobRoleId;
	}
}
