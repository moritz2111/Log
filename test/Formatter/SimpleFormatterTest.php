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

/*class SimpleFormatterTest extends TestCase
{

    
        public function setup(): void
        {
            $this->filter = new SimpleFormatter();
        }

        public function testFormatisnull()
        {
            $this->assertTrue($this->filter->accept(array('message' => '', 'level' === 0)));
            ->assertNull
        }

        public function testFormatisnotnull()
        {
            /*$this->assertFalse($this->filter->accept(array('message' => '', 'level' != 1)));
            ->assertNotNull
        }
    
    } */
    
    class SimpleFormatterTest1 extends LogMessage
    {
    
        public function testDefaultFormat()
    {
        $f = new SimpleFormatter();
        $line = $f->format(array('context' => $context = 'context', 'name' => $name = 1));
        
        $this->assertStringContainsString($context, $line);
        $this->assertStringContainsString((string)$name, $line);
    } 

    public function testDeclarationIsStripped()
    {
        $f = new SimpleFormatter();
        $line = $f->format(array('context' => $context = 'context', 'name' => $name = 0));

        $this->assertStringNotContainsString ('Hallo', $line);
    }

        public function testConstructorThrowsOnBadFormatString()
    {
       $this->expectException(TypeError::class);
       new SimpleFormatter();
    } 
}
