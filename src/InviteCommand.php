<?php
namespace Haruair;
use Broadway;


class InviteCommand extends InvitationCommand
{
    public $name;
    public function __construct($invitationId, $name)
    {
        parent::__construct($invitationId);
        $this->name = $name;
    }
}