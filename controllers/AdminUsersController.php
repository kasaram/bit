<?php

defined('BIT') or die;

class AdminUsersController extends AdminBase
{

	public function actionIndex()
	{
		self::checkAdmin();
		$listUsers = User::getUsersAll();
		require_once ROOT.'/'.Config::VIEW.'admin/users.php';
		return true;
	}

	public function actionUpdate($id)
	{
		self::checkAdmin();
		if (isset($id)) {
			$result = User::changeUser(['balance'=>'0'],$id);
			$res = isset($result) ? 'suc_user_zero' : 'fail_user_zero';
		} else $res = 'fail_user_zero';
		header('Location:'.Config::ADDRESS.'admin/users/?res='.$res);
	}

}
