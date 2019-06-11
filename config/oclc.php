<?php


return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('OCLC_ENV', 'development'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [


        'development' => [
            'host' => env('OCLC_URL', '127.0.0.1'),
            'port' => env('OCLC_PORT', '3306'),
	    'institution_id' => env('OCLC_REG_ID', ''),
            'api_key' => env('OCLC_API_KEY', ''),
	    'api_secret' => env('OCLC_API_SECRET', ''),
	    'ppid' => env('OCLC_PPID', ''),
	    'pdns' => env('OCLC_PDNS', ''),
	    'home_branch' => env('OCLC_HOMEBRANCH', ''),
	    'url' => 'https://'.env('OCLC_REG_ID', '').'.share.worldcat.org/idaas/'
        ],

        'production' => [
	    'host' => env('OCLC_URL', '127.0.0.1'),
            'port' => env('OCLC_PORT', '3306'),
	    'institution_id' => env('OCLC_REG_ID', ''),
            'api_key' => env('OCLC_API_KEY', 'forge'),
            'api_secret' => env('OCLC_API_SECRET', ''),
	    'ppid' => env('OCLC_PPID', ''),
	    'pdns' => env('OCLC_PDNS', ''),
	    'home_branch' => env('OCLC_HOMEBRANCH', ''),
	    'url' => 'https://'.env('OCLC_REG_ID').'.share.worldcat.org/idaas/'
        ],
    ],


];


