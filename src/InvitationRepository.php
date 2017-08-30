<?php
namespace Haruair;
use Broadway;


class InvitationRepository extends Broadway\EventSourcing\EventSourcingRepository
{
    public function __construct(Broadway\EventStore\EventStore $eventStore, Broadway\EventHandling\EventBus $eventBus)
    {
        parent::__construct($eventStore, $eventBus, 'Haruair\Invitation', new Broadway\EventSourcing\AggregateFactory\PublicConstructorAggregateFactory());
    }
}
