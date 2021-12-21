<?php
/**
 * @author     Moritz Reiter
 * @category   Horde
 * @package    Log
 * @subpackage UnitTests
 */

namespace Horde\Log\Test\Formatter;
use PHPUnit\Framework\Testcase;
use Horde\Log\Formatter\SimpleFormatter;
use Horde\Log\LogMessage;
use Horde\Log\LogFormatter;


class SimpleFormatterTest extends TestCase
{
        public function setup(): void
        {
            $this->filter = new SimpleFormatter();
        }

        public function Formatisnull()
        {
            $this->assertTrue($this->filter->accept(array('message' => '', 'level' === 0)));
        }

        public function Formatisnotnull()
        {
            $this->assertFalse($this->filter->accept(array('message' => '', 'level' != 1)));
        }
        
        public function testConstructorThrowsOnBadFormatString()
    {
        $this->expectException('InvalidArgumentException');
        new SimpleFormatter(1);
        $this->expectException('Falsches Argument');
        new SimpleFormatter(2);
        $this->expectException('Error');
        new SimpleFormatter(3);
        $this->expectException('error');
        new SimpleFormatter(4);
        $this->expectException('InvalidOperator');
        new SimpleFormatter(5);
    }
}