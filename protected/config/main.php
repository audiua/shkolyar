<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// Yii::setPathOfAlias('booster', dirname(__FILE__).DIRECTORY_SEPARATOR.'../vendor/clevertech/yii-booster/src');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'SHKOLYAR.INFO',
	'sourceLanguage'=>'en',
	'language'=>'ru',
	'theme'=>'market',
	// 'defaultController'=>'gdz',

	// preloading 'log' component
	'preload'=>array(
		'log', 
	),

	//GZIP compress   
	// 'onBeginRequest'=>create_function('$event', 'return ob_start("ob_gzhandler");'),
	// 'onEndRequest'=>create_function('$event', 'return ob_end_flush();'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.extensions.*',
		'application.components.*',
		// 'application.components.widgets.*',
		// 'application.components.widgets.subjectWidget.*',
		// 'application.components.widgets.clasNumbWidget.*',
		// 'application.components.widgets.bookWidget.*',
		// 'application.components.widgets.oneBookWidget.*',
		// 'application.components.widgets.taskWidget.*',
		'application.components.widgets.taskTitleWidget.*',
		// 'application.components.widgets.tabWidget.*',
		'application.components.widgets.nestedWidget.*',
		// 'application.components.widgets.tizerWidget.*',
		'application.components.widgets.relativeBooksWidget.*',

		'application.helpers.*',
		'application.widgets.clasNumbWidget.*',
		'application.widgets.clasNumbCurrentSubjectWidget.*',
		'application.widgets.subjectWidget.*',
		'application.widgets.bookWidget.*',
		'application.widgets.dataBookWidget.*',
		'application.widgets.oneBookWidget.*',
		'application.widgets.taskWidget.*',
		'application.widgets.breadcrumdsWidget.*',
		'application.widgets.relativeGdzWidget.*',
		'application.widgets.bookSidebarMenuWidget.*',

		'ext.ExtendedClientScript.jsmin.*',
		'ext.ExtendedClientScript.cssmin.*'
	),

	'modules'=>array(

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'admin',
		
	),

	// application components
	'components'=>array(

		'request'=>array(
            'enableCsrfValidation'=>false,
            'enableCookieValidation'=>false,
        ),

		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				// '<clas:\d+>/<subject:\w+>/<book:\w+>/<unit:\d+>/<lesson:[0-9]+[-]?[0-9]{0,2}>/<page:\d+>/<task:[0-9]+[-]?[0-9ab]{0,2}>'=>'site/task',
				// '<clas:\d+>/<subject:\w+>/<book:\w+>/<unit:\d+>/<lesson:[0-9]+[-]?[0-9]{0,2}>/<task:\d+>'=>'site/task',
				// '<clas:\d+>/<subject:\w+>/<book:\w+>/<lesson:\d+>/<task:\d+>'=>'site/task',
				// '<controller:\w+>/<clas:\d+>/<subject:\w+>/<book:\w+>/<section:\d+>/<paragraph:\d+>/<task:\d+>'=>'<controller:\w+>/nestedTwo',
				// '<clas:\d+>/<subject:\w+>/<book:\w+>'=>'site/book',
				'/site/page' => 'site/page',
				'<controller:\w+>/search'=>'site/search',

				'<controller:\w+>/<clas:\d+>/<subject:[a-z-]+>/<book:[a-z-]+>/<section:\d+>/<paragraph:\d+>/<task:\d+>'=>'<controller>/nestedTwo',
				'<controller:\w+>/<clas:\d+>/<subject:[a-z-]+>/<book:[a-z-]+>/<section:\d+>/<task:\d+>'=>'<controller>/nestedOne',
				'<controller:\w+>/<clas:\d+>/<subject:[a-z-]+>/<book:[a-z-]+>/<task:\d+>'=>'<controller>/task',
				'<controller:\w+>/<clas:\d+>/<subject:[a-z-]+>/<book:[a-z-]+>'=>'<controller>/book',
				'<controller:\w+>/<clas:\d+>/<subject:[a-z-]+>'=>'<controller>/subject',
				'<controller:\w+>/<clas:\d+>'=>'<controller>/clas',
				'<controller:\w+>'=> '<controller>/index',

				// '<controller:\w+>/<subject:[a-z-]+>'=>'<controller>/currentSubject',
				

				'tizer'=>'tizer/index',
				'position'=>'position/index',
				'sitemap.xml'=>'sitemap/index',
				
				
				
				

				// '<controller:\w+>/<id:\d+>'=>'<controller>/view',
				// '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				// '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),

		'db'=> require(dirname(__FILE__).'/_db.php'),
		
		'errorHandler'=>array(
			'errorAction'=>'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				
				// array(
				// 	'class'=>'CWebLogRoute',
				// ),
				
			),
		),

		'cache'=>array(
            'class'=>'system.caching.CDummyCache',
        ),

        'clientScript'=>array(
            'class'=>'ext.ExtendedClientScript.ExtendedClientScript',
            'combineCss'=>false,
            'compressCss'=>false,
            'combineJs'=>false,
            'compressJs'=>false,
        ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'audiua@yandex.ru',
	),
);