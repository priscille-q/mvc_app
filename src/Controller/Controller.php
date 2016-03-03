<?php
namespace priscille_q\mvc_app\Controller;

class Controller
{
	private $getParameter = array();
	private $postParameter = array();

	public function __construct()
	{
		$this->setGetParameter();
		$this->setPostParameter();
	}

	protected function setPostParameter()
	{
		foreach($_POST as $key => $value)
		{
			$this->postParameter[$key] = $value;
		}
	}

	protected function setGetParameter()
	{
		foreach($_GET as $key => $value)
		{
			$this->getParameter[$key] = $value;
		}
	}

	protected function getPostParameter($key = null)
	{
		if (is_null($key))
		{
			return $this->postParameter;
		}
		return isset($this->postParameter[$key]) ? $this->postParameter[$key] : null;
	}

	protected function getGetParameter($key = null)
	{
		if (is_null($key))
		{
			return $this->getParameter;
		}
		return isset($this->getParameter[$key]) ? $this->getParameter[$key] : null;
	}
}
