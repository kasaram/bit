<?php
defined('BIT') or die;

class AdminUsersController extends AdminBase
{
	/**
	 * Отображает игроков, у которых достигнута значение денег для снятия и которые указали у 
	 * себя в настройках авто снятие платежа
	 */
	public function actionIndex()
	{
		self::checkAdmin();
		$listUsers = User::getUsersAll();
		require_once ROOT.'/'.Config::VIEW.'admin/users.php';
		return true;
	}

	/**
	 * Производит обнуление баланса у игрока
	 */
	public function actionUpdate($id, $balance)
	{
		self::checkAdmin();
		if (isset($id)) {
			$time = time();
			$result = User::changeUser(['balance'=>'0', 'refBonus'=>'0', 'lastPayOut'=>$balance, 'lastDateOut'=>$time],$id);
			$res = isset($result) ? 'suc_user_zero' : 'fail_user_zero';
		} else $res = 'fail_user_zero';
		header('Location:'.Config::ADDRESS.'admin/users/?res='.$res);
	}

}
