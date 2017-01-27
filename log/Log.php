<?php
require_once __DIR__ . '/../vendor/autoload.php';

class Log {
    public static function logit($info) {
        // show the list of users
        $log = new Monolog\Logger('LOG NAME');
        $log->pushHandler(new Monolog\Handler\StreamHandler(__DIR__ . '/log.txt', Monolog\Logger::DEBUG));

        $log->info($info);
    }
}