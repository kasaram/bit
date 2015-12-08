<?php
return [
	'page' => 'admin/page', //actionPage в AdminController
	'admin/logout' => 'admin/logout', //actionLogout в AdminController
	'admin/login' => 'admin/login', //actionLogin в AdminController
	'admin/users/update/([a-z0-9]+)' =>'adminUsers/update/$1', //actionUpdate в AdminUsersController
	'admin/users' =>'adminUsers/index', //actionIndex в AdminUsersController
	'admin/video/delete/([a-z0-9]+)' =>'adminVideo/delete/$1', //actionDelete в AdminVideoController
	'admin/video/update/([a-z0-9]+)' =>'adminVideo/update/$1', //actionUpdate в AdminVideoController
	'admin/video/create' =>'adminVideo/create', //actionCreate в AdminVideoController
	'admin/video' =>'adminVideo/index', //actionIndex в AdminVideoController
	'admin/reclama/delete/([a-z0-9]+)' =>'adminReclama/delete/$1', //actionDelete в AdminReclamaController
	'admin/reclama/update/([a-z0-9]+)' =>'adminReclama/update/$1', //actionUpdate в AdminReclamaController
	'admin/reclama/create' =>'adminReclama/create', //actionCreate в AdminReclamaController
	'admin/reclama' =>'adminReclama/index', //actionIndex в AdminReclamaController
	'admin/banners/delete/([a-z0-9]+)' =>'adminBanners/delete/$1', //actionDelete в AdminBannersController
	'admin/banners/update/([a-z0-9]+)' =>'adminBanners/update/$1', //actionUpdate в AdminBannersController
	'admin/banners/create' =>'adminBanners/create', //actionCreate в AdminBannersController
	'admin/banners/add' =>'adminBanners/add', //actionAdd в AdminBannersController
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
	'bonus/claim' =>'bonus/claim', //actionClaim в BonusController
	'bonus/start' =>'bonus/start', //actionStart в BonusController
	'bonus' =>'bonus/index', //actionIndex в BonusController
	'games/([a-z0-9]+)' => 'site/games/$1', //actionGames в SiteController
	'claim' => 'site/claim', //actionClaim в SiteController
	'login' => 'site/login', //actionLogin в SiteController
	'logout' => 'site/logout' //actionLogout в SiteController
];
