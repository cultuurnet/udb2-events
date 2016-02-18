<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String;

class EventUpdatedTest extends \PHPUnit_Framework_TestCase
{
    private function createEventUpdated(\DateTimeImmutable $time = null)
    {
        if (null === $time) {
            $time = new \DateTimeImmutable();
        }

        return new EventUpdated(
            $time,
            new String('me@example.com'),
            new String('http://foo.bar/event/foo')
        );
    }

    public function testGetAuthor()
    {
        $eventUpdated = $this->createEventUpdated();

        $this->assertEquals(
            new String('me@example.com'),
            $eventUpdated->getAuthor()
        );
    }

    public function testTime()
    {
        $time = new \DateTimeImmutable();
        $expectedTime = clone $time;

        $eventUpdated = $this->createEventUpdated($time);

        // Adjustments to the time after creating the event should
        // not affect the event time.
        $time->modify('+5 days');

        $this->assertEquals(
            $expectedTime,
            $eventUpdated->getTime()
        );
    }

    public function testGetUrl()
    {
        $eventUpdated = $this->createEventUpdated();

        $this->assertEquals(
            new String('http://foo.bar/event/foo'),
            $eventUpdated->getUrl()
        );
    }
}
