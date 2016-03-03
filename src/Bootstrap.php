<?php
namespace priscille_q\mvc_app;

use \priscille_q\mvc_app\Controller\Controller;
use \priscille_q\mvc_app\Controller\IndexController;

class Bootstrap
{
	const DEFAULT_CONTROLLER = '\\' . __NAMESPACE__ . '\\Controller\\' . 'IndexController';
	const DEFAULT_ACTION = 'index';
	const MAIN_CONTROLLER = '\\' . __NAMESPACE__ . '\\Controller\\' .'Controller';

	private $controllerName;
	private $actionName;
	private $useDefaultParameter = false;

	public function run()
	{
		$this->load();
		$actionName = $this->actionName;

		$controllerName = $this->controllerName;

		$controller = new $this->controllerName();

		if (!is_object($controller) || !is_subclass_of($controller, self::MAIN_CONTROLLER))
		{
			$this->useDefaultParameter = true;
		}

		if (!$this->useDefaultParameter)
		{
			if (!method_exists($controller, $this->actionName))
			{
				$this->useDefaultParameter = true;
			}
		}

		if ($this->useDefaultParameter)
		{
			$this->controllerName = self::DEFAULT_CONTROLLER;
			$controller = new $this->controllerName();
			if (!is_object($controller) || !is_subclass_of($controller, self::MAIN_CONTROLLER))
			{
				var_dump($controller);
				throw new \Exception('Invalid Controller, got ' . var_export($controller, true));
			}
			$actionName = self::DEFAULT_ACTION;
		}

		$controller->$actionName();
	}

	protected function load()
	{
		// gets
		// post
		$this->controllerName = isset($_GET['c']) ? '\\' . __NAMESPACE__ . '\\Controller\\' . ucfirst($_GET['c']) .'Controller' : self::DEFAULT_CONTROLLER;
		if (!class_exists($this->controllerName))
		{
			error_log('Try to call an undefined controller : ' . var_export($this->controllerName, true));
			$this->controllerName = self::DEFAULT_CONTROLLER;
		}
		$this->actionName = isset($_GET['a']) ? $_GET['a'] : self::DEFAULT_ACTION;
	}
}
