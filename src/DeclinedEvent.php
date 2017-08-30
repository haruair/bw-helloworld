<?php
namespace Haruair;
use Broadway;


class DeclinedEvent extends InvitationEvent
{
    public static function deserialize(array $data)
    {
        return new Self($data['invitationId']);
    }

    public function serialize()
    {
        return [
            'invitationId' => $this->invitationId,
        ];
    }
}
