<?php
require_once __DIR__ . '/../vendor/autoload.php';
$mapper = new LogMapper();
$handler = new Horde_Log_Handler_Sql($mapper);
$logger = new Horde_Log_Logger();
$logger->addHandler($handler);
$logger->notice(['message' => "bar", 'timestamp' => time()]);