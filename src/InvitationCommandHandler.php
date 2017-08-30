<?php
namespace Haruair;
use Broadway;


class InvitationCommandHandler extends Broadway\CommandHandling\SimpleCommandHandler
{
    private $repository;

    public function __construct(Broadway\EventSourcing\EventSourcingRepository $repository)
    {
        $this->repository = $repository;
    }

    protected function handleInviteCommand(InviteCommand $command)
    {
        $invitation = Invitation::invite($command->invitationId, $command->name);

        $this->repository->save($invitation);
    }

    protected function handleAcceptCommand(AcceptCommand $command)
    {
        $invitation = $this->repository->load($command->invitationId);
        $invitation->accept();
        $this->repository->save($invitation);
    }

    protected function handleDeclineCommand(DeclineCommand $command)
    {
        $invitation = $this->repository->load($command->invitationId);
        $invitation->decline();
        $this->repository->save($invitation);
    }
}
