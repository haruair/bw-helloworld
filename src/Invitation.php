<?php
namespace Haruair;
use Broadway;

class Invitation extends Broadway\EventSourcing\EventSourcedAggregateRoot
{
    private $accepted = false;
    private $declined = false;
    private $invitationId;
    private $name;

    public static function invite($invitationId, $name)
    {
        $invitation = new Invitation();

        $invitation->apply(new InvitedEvent($invitationId, $name));
        return $invitation;
    }

    public function getAggregateRootId()
    {
        return $this->invitationId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function accept()
    {
        if ($this->declined) {
            throw new \RuntimeException('Already declined.');
        }

        if ($this->accepted) {
            return;
        }

        $this->apply(new AcceptedEvent($this->invitationId));
    }

    public function decline()
    {
        if ($this->accepted) {
            throw new \RuntimeException('Already accepted');
        }

        if ($this->declined) {
            return;
        }

        $this->apply(new DeclinedEvent($this->invitationId));
    }

    protected function applyAcceptedEvent(AcceptedEvent $event)
    {
        $this->accepted = true;
    }

    protected function applyDeclinedEvent(DeclinedEvent $event)
    {
        $this->declined = true;
    }

    protected function applyInvitedEvent(InvitedEvent $event)
    {
        $this->invitationId = $event->invitationId;
        $this->name = $event->name;
    }
}
