<?php
require_once __DIR__ . '/../vendor/autoload.php';


$handler = new Horde_Log_Handler_Cli(new Horde_Log_Formatter_Json());
$logger = new Horde_Log_Logger();
$logger->addHandler($handler);
$logger->notice(['message' => "bar", 'timestamp' => time()]);