<?php

 /* @author     Moritz Reiter
 * @category   Horde
 * @package    Log
 * @subpackage UnitTests*/

    namespace Horde\Log\Test\Formatter;
    use PHPUnit\Framework\Testcase;
    use Horde\Log\Formatter\SimpleFormatter;
    use Horde\Log\LogMessage;
    use Horde\Log\LogLevel;

    class SimpleFormatterTest extends TestCase
{
    
    public function testDefaultFormat()

    {

    $f = new SimpleFormatter('%message% %context%');

    $context = 'testValue';

    $logLevel = new LogLevel(1, 'testLevel');

    $message = 'test message';

    $logMessage = new LogMessage($logLevel, $message, ['context' => $context ]);

    $logMessage->formatMessage([]);

    $line = $f->format($logMessage);

    /*var_dump ($line);*/

    $this->assertEquals('test message testValue', $line);

    }
}