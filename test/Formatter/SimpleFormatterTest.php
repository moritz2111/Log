<?php

namespace Horde\Log\Test\Formatter;
use PHPUnit\Framework\Testcase;
use Horde\Log\Formatter\SimpleFormatter;
use Horde\Log\LogMessage;
use horde\Log\LogFormatter;
use Horde\Log;



class SimpleFormatterTest extends TestCase
{
    public  function testConstructorThrowsOnBadFormatString()
    {
        $this->expectException('InvalidArgumentException');
        new SimpleFormatter(1);
    }
}

class ShouldNeverBeRunEither extends SimpleFormatterTest
{
}

class TestOfStackTrace extends TestCase
{
    public function testCanFindAssertInTrace()
    {
        $trace = new SimpleStackTrace(['assert']);
        $this->assertEqual(
            $trace->traceMethod([[
                'file' => 'TestCase',
                'line' => 24,
                'function' => 'assertSomething', ]]),
                ' at [TestCase line 24]'
            );
    }
}

class DummyResource
{
}

class TestOfContext extends TestCase
{
    public function testCurrentContextIsUnique()
    {
        $this->assertSame(
            SimpleFormatterTest::getContext(),
            SimpleFormatterTest::getContext(1)
        );
    }

    public function testContextHoldsCurrentTestCase()
    {
        $context = SimpleFormatterTest::getContext();
        $this->assertSame($this, $context->getTest());
    }

    public function testResourceIsSingleInstanceWithContext()
    {
        $context = new SimpleTestContext();
        $this->assertSame(
            $context->get('DummyResource'),
            $context->get('DummyResource')
        );
    }

    public function testClearingContextResetsResources()
    {
        $context = new SimpleTestContext(1);
        $resource = $context->get('DummyResource');
        $context->clear();
        $this->assertClone($resource, $context->get('DummyResource'));
    }
}