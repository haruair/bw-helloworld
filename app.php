<?php
require_once(__DIR__.'/vendor/autoload.php');

// $commandHandler = new Haruair\MyCommandHandler;

// $commandBus = new Broadway\CommandHandling\SimpleCommandBus;
// $commandBus->subscribe($commandHandler);

// $command = new Haruair\MyCommand('Hi from command!');
// $commandBus->dispatch($command);

// $eventStore = new Broadway\EventStore\InMemoryEventStore;

use MongoDB\Client;

$generator = new Broadway\UuidGenerator\Rfc4122\Version4Generator();

$mongo = new Client('mongodb://localhost:27017');
$collection = $mongo->selectCollection('default', 'events');

$payload = new Broadway\Serializer\SimpleInterfaceSerializer;
$metadata = new Broadway\Serializer\SimpleInterfaceSerializer;

$eventStore = new Broadway\EventStore\MongoDB\MongoDBEventStore($collection, $payload, $metadata);
$eventBus = new Broadway\EventHandling\SimpleEventBus;

$repository = new Haruair\InvitationRepository($eventStore, $eventBus);
$commandHandler = new Haruair\InvitationCommandHandler($repository);

$commandBus = new Broadway\CommandHandling\SimpleCommandBus;
$commandBus->subscribe($commandHandler);

$id = $generator->generate();
echo $id . PHP_EOL;
// $id = 'be7f6038-2f4b-4bd1-9ef4-74988d033b67';

$command = new Haruair\InviteCommand($id, 'edward');
$commandBus->dispatch($command);

$invitation = $repository->load($id);
var_dump($invitation);
$invitation->accept();

$repository->save($invitation);

var_dump($invitation);
// $accepted = new Haruair\AcceptCommand($id);
// $commandBus->dispatch($accepted);

// $v = $repository->load($id);
// var_dump($v);
