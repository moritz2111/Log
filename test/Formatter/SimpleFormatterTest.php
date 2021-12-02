<?php
/**
 * Horde Log package
 *
 * This package is based on Zend_Log from the Zend Framework
 * (http://framework.zend.com).  Both that package and this
 * one were written by Mike Naberezny and Chuck Hagenbuch.
 *
 * @author     Mike Naberezny <mike@maintainable.com>
 * @author     Chuck Hagenbuch <chuck@horde.org>
 * @category   Horde
 * @license    http://www.horde.org/licenses/bsd BSD
 * @package    Log
 * @subpackage UnitTests
 */
namespace Horde\Log\Test\Formatter;
use PHPUnit\Framework\Testcase;
use Horde\Log\Formatter\SimpleFormatter;
use Horde\Log\LogMessage;
use horde\Log\LogFormatter;
use Horde\Log;


/**
 * @author     Mike Naberezny <mike@maintainable.com>
 * @author     Chuck Hagenbuch <chuck@horde.org>
 * @category   Horde
 * @license    http://www.horde.org/licenses/bsd BSD
 * @package    Log
 * @subpackage UnitTests
 */
class SimpleFormatterTest extends Testcase
{
    public function testConstructorThrowsOnBadFormatString()
    {
        $this->expectException('InvalidArgumentException');    
        new SimpleFormatter(1);
    }

    public function testDefaultFormat()
    {
        $f = new SimpleFormatter(2);
        $line = $f->format(array('message' => $message = 'message',
                                 'level' => $level = Horde\Log::ALERT,
                                 'levelName' => $levelName = 'ALERT'));

        $this->assertStringContainsString($message, $line);
        $this->assertStringContainsString($levelName, $line);
    }
}

?>