<?php
/*
 * Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

return new \Phalcon\Config([
    'database' => [
        'adapter'    => 'Mysql',
        'host'       => $_ENV['DB_HOST'],
        'username'   => $_ENV['DB_USER'],
        'password'   => $_ENV['DB_PASSWORD'],
        'dbname'     => $_ENV['DB_NAME'],
        'charset'    => 'utf8',
    ],

    'application' => [
        'modelsDir'      => APP_PATH . '/models/',
        'controllersDir'      => APP_PATH . '/controllers/',
        'baseUri'        => '/',
    ]
]);
