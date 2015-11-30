<?php

defined('BIT') or die;

abstract class AdminBase
{
	public static function checkAdmin()
	{
		if(session_status() !== PHP_SESSION_ACTIVE) session_start();
		if (!isset($_SESSION['adm_log'])) {
			header('Location: '.Config::ADDRESS);
			die();
		}
	}

}
