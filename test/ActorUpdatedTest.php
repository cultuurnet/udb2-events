<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String;

class ActorUpdatedTest extends \PHPUnit_Framework_TestCase
{
    private function createActorUpdated(\DateTimeImmutable $time = null)
    {
        if (null === $time) {
            $time = new \DateTimeImmutable();
        }

        return new ActorUpdated(
            $time,
            new String('me@example.com'),
            new String('http://foo.bar/event/foo')
        );
    }

    public function testGetAuthor()
    {
        $actorUpdated = $this->createActorUpdated();

        $this->assertEquals(
            new String('me@example.com'),
            $actorUpdated->getAuthor()
        );
    }

    public function testTime()
    {
        $time = new \DateTimeImmutable();
        $expectedTime = clone $time;

        $actorUpdated = $this->createActorUpdated($time);

        // Adjustments to the time after creating the event should
        // not affect the event time.
        $time->modify('+5 days');

        $this->assertEquals(
            $expectedTime,
            $actorUpdated->getTime()
        );
    }

    public function testUrl()
    {
        $actorUpdated = $this->createActorUpdated();

        $this->assertEquals(
            new String('http://foo.bar/event/foo'),
            $actorUpdated->getUrl()
        );
    }
}
