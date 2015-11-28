<?php
return [
	'admin/banners/delete/([a-z0-9]+)' =>'adminBanners/delete/$1', //actionDelete в AdminBannersController
	'admin/banners/update/([a-z0-9]+)' =>'adminBanners/update/$1', //actionUpdate в AdminBannersController
	'admin/banners/create' =>'adminBanners/create', //actionCreate в AdminBannersController
	'admin/banners' =>'adminBanners/index', //actionIndex в AdminBannersController
	'admin/service' =>'admin/service', //actionService в AdminController
	'admin/design' =>'admin/design', //actionDesign в AdminController
	'admin/game' =>'admin/game', //actionGame в AdminController
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
