<?php
namespace Haruair;
use Broadway;

abstract class InvitationCommand
{
    public $invitationId;
    public function __construct($invitationId)
    {
        $this->invitationId = $invitationId;
    }
}
