<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'db' => array(
        'driver'            => 'Pdo',
        'dsn'               => 'pgsql:dbname=dbsemec;host=localhost;port=5432',
        'driver_options'    => array(
       //     PDO::PGSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'AdapterDb'   => 'Zend\Db\Adapter\AdapterServiceFactory', // new \Zend\Db\Adapter\AdapterServiceFactory
        ),
    ),
);
