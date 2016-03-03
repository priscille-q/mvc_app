<?php
namespace priscille_q\mvc_app\Controller;

use priscille_q\mvc_app\Controller\Controller;
use priscille_q\mvc_app\Model\PerformUpdate;

class IndexController extends Controller
{
	private $view = __DIR__ . '/../View/form.html';
	public function index()
	{
		$people = (array) $this->getPostParameter('people');
		$performUpdate = new PerformUpdate($people);
		$performUpdate->execute();
		include_once $this->view;
	}

	// public function update()
	// {
	// 	$this->index();
	// }

	public function delete()
	{
		echo 'delete';
		$this->index();
	}
}
