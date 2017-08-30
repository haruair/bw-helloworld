<?php
namespace Haruair;
use Broadway;


class InvitedEvent extends InvitationEvent
{
    public $name;
    public function __construct($invitationId, $name)
    {
        parent::__construct($invitationId);
        $this->name = $name;
    }

    public static function deserialize(array $data)
    {
        return new InvitedEvent($data['invitationId'], $data['name']);
    }

    public function serialize()
    {
        return [
            'invitationId' => $this->invitationId,
            'name' => $this->name,
        ];
    }
}
