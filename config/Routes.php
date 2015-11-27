<?php
return [
	'admin/([a-z0-9]+)' =>'admin/$1', //actionIndex в AdminController
	'admin' =>'admin/index', //actionIndex в AdminController
	'refer' =>'refer/index',  //actionIndex в ReferController
	'faq' =>'faq/index', //actionIndex в FaqController
	'account/bitcoin' =>'account/bitcoin', //actionBitcoin в AccountController
	'account/withdraw' =>'account/withdraw', //actionWithdraw в AccountController
	'account' =>'account/index', //actionIndex в AccountController
	'contact' =>'contact/index', //actionIndex в ContactController
	'bonus' =>'bonus/index', //actionIndex в BonusController
	'login' => 'site/login', //actionLogin в SiteController
	'logout' => 'site/logout' //actionLogout в SiteController
];
