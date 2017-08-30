<?php
namespace Haruair;
use Broadway;


abstract class InvitationEvent implements Broadway\Serializer\Serializable
{
    public $invitationId;

    public function __construct($invitationId)
    {
        $this->invitationId = $invitationId;
    }

    abstract public static function deserialize(array $data);
    abstract public function serialize();
}
