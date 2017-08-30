<?php
namespace Haruair;
use Broadway;


use Broadway;

class MyCommandHandler extends Broadway\CommandHandling\SimpleCommandHandler
{
	public function handleMyCommand(MyCommand $command)
	{
		echo $command->getMessage() . PHP_EOL;
	}
}
