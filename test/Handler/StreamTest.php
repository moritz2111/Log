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
namespace Horde\Log\Test\Handler;
use \PHPUnit\Framework\TestCase;
use \Horde_Log_Handler_Stream;
use \Horde_Log;

/**
 * @author     Mike Naberezny <mike@maintainable.com>
 * @author     Chuck Hagenbuch <chuck@horde.org>
 * @category   Horde
 * @license    http://www.horde.org/licenses/bsd BSD
 * @package    Log
 * @subpackage UnitTests
 */
class StreamTest extends TestCase
{
    public function setUp(): void
    {
        date_default_timezone_set('America/New_York');
    }

    public function testConstructorThrowsWhenResourceIsNotStream()
    {
        $this->expectException('Horde_Log_Exception');
        $resource = xml_parser_create();
        new Horde_Log_Handler_Stream($resource);
        xml_parser_free($resource);
    }

    public function testConstructorWithValidStream()
    {
        $stream = fopen('php://memory', 'a');
        new Horde_Log_Handler_Stream($stream);
        $this->markTestSkipped('No Exception expected.');
    }

    public function testConstructorWithValidUrl()
    {
        new Horde_Log_Handler_Stream('php://memory');
        $this->markTestSkipped('No Exception expected.');
    }

    public function testConstructorThrowsWhenModeSpecifiedForExistingStream()
    {
        $this->expectException('Horde_Log_Exception');
        $stream = fopen('php://memory', 'a');
        new Horde_Log_Handler_Stream($stream, 'w');
    }

    public function testConstructorThrowsWhenStreamCannotBeOpened()
    {
        $this->expectException('Horde_Log_Exception');
        new Horde_Log_Handler_Stream('');
    }

    public function testSettingBadOptionThrows()
    {
        $this->expectException('Horde_Log_Exception');
        $handler = new Horde_Log_Handler_Stream('php://memory');
        $handler->setOption('foo', 42);
    }

    public function testWrite()
    {
        $stream = fopen('php://memory', 'a');

        $handler = new Horde_Log_Handler_Stream($stream);
        $handler->write(array('message' => $message = 'message-to-log',
                              'level' => $level = Horde_Log::ALERT,
                              'levelName' => $levelName = 'ALERT',
                              'timestamp' => date('c')));

        rewind($stream);
        $contents = stream_get_contents($stream);
        fclose($stream);

        $date = '\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}-\d{2}:\d{2}';

        $this->assertMatchesRegularExpression("/$date $levelName: $message/", $contents);
    }

    public function testWriteThrowsWhenStreamWriteFails()
    {
        $this->expectException('Horde_Log_Exception');
        $stream = fopen('php://memory', 'a');
        $handler = new Horde_Log_Handler_Stream($stream);
        fclose($stream);
        $handler->write(array('message' => 'foo', 'level' => 1));
    }

}
