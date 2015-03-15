<?php
/**
 * @file
 */

namespace CultuurNet\UDB2DomainEvents;

use ValueObjects\String\String;

class EventCreated
{
    use HasEventIdTrait;
    use HasAuthoringMetadataTrait;

    /**
     * @param String $eventId
     * @param \DateTime $time
     */
    public function __construct(String $eventId, \DateTimeImmutable $time, String $author)
    {
        $this->setEventId($eventId);
        $this->setTime($time);
        $this->setAuthor($author);
    }
}
