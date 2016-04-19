<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String as StringLiteral;
use ValueObjects\Web\Url;

class ActorCreatedTest extends \PHPUnit_Framework_TestCase
{
    public function testActorIdCanNotBeEmptyString()
    {
        $this->setExpectedException(
            \InvalidArgumentException::class,
            'actor id can not be empty'
        );

        new ActorCreated(
            new StringLiteral(''),
            new \DateTimeImmutable(),
            new StringLiteral(''),
            Url::fromNative('http://foo.bar/event/foo')
        );
    }

    private function createActorCreated(\DateTimeImmutable $time = null)
    {
        if (null === $time) {
            $time = new \DateTimeImmutable();
        }

        return new ActorCreated(
            new StringLiteral('123'),
            $time,
            new StringLiteral('me@example.com'),
            Url::fromNative('http://foo.bar/event/foo')
        );
    }

    public function testGetActorId()
    {
        $eventCreated = $this->createActorCreated();

        $this->assertEquals(
            new StringLiteral('123'),
            $eventCreated->getActorId()
        );
    }

    public function testGetAuthor()
    {
        $eventCreated = $this->createActorCreated();

        $this->assertEquals(
            new StringLiteral('me@example.com'),
            $eventCreated->getAuthor()
        );
    }

    public function testTime()
    {
        $time = new \DateTimeImmutable();
        $expectedTime = clone $time;

        $eventCreated = $this->createActorCreated($time);

        // Adjustments to the time after creating the event should
        // not affect the event time.
        $time->modify('+5 days');

        $this->assertEquals(
            $expectedTime,
            $eventCreated->getTime()
        );
    }

    public function testUrl()
    {
        $eventCreated = $this->createActorCreated();

        $this->assertEquals(
            Url::fromNative('http://foo.bar/event/foo'),
            $eventCreated->getUrl()
        );
    }

    public function testSerialization()
    {
        $time = new \DateTimeImmutable("2016-04-15T16:06:11+0200");
        $eventCreated = $this->createActorCreated($time);
        $expectedData = [
            "actorId" => "123",
            "time" => "2016-04-15T16:06:11+0200",
            "author" => "me@example.com",
            "url" => "http://foo.bar/event/foo",
        ];

        $this->assertEquals(
            $expectedData,
            $eventCreated->serialize()
        );
    }
}
