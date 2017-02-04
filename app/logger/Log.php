<?php

namespace app\logger;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Log {
    public static function logit($info) {
        // make sure to chmod that file
        $log = new Logger('LOG NAME');
        $log->pushHandler(new StreamHandler(__DIR__ . '/log.txt', Logger::DEBUG));
        $log->info($info);
    }
}