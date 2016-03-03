<?php
namespace priscille_q\mvc_app\Controller;

use priscille_q\mvc_app\Controller\Controller;
use priscille_q\mvc_app\Model\PerformUpdate;
use priscille_q\mvc_app\Model\JobRoleDB;
use priscille_q\mvc_app\Model\PersonDB;

class IndexController extends Controller
{
	private $view = __DIR__ . '/../View/form.php';

	public function index()
	{
		$people = (array) $this->getPostParameter('people');
		if (!is_null($people))
		{
			$performUpdate = new PerformUpdate($people);
			if ($performUpdate->execute())
			{
				$people = array();
			}
		}
		if (empty($people))
		{
			$personDB = personDB::getPersonDB();
			$people = $personDB->getPersonList();
		}
		$JobRoleDB = JobRoleDB::getJobRoleDB();
		$jobRoleList = $JobRoleDB->getJobRoleList();
		include_once $this->view;
	}
}
