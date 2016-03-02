<?php
namespace priscille_q\mvc_app\Controller;

use priscille_q\mvc_app\Controller\Controller;

class IndexController extends Controller
{
	public function index()
	{
		echo 'test';
	}

	public function create()
	{
		echo 'create';
	}

	public function update()
	{
		echo 'update';
	}

	public function delete()
	{
		echo 'delete';
	}
}
