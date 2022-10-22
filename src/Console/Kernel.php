<?php

namespace Html\Parser\Console;

use Html\Parser\Console\Commands\Command;
use Html\Parser\Console\Commands\ParserCommand;
use Html\Parser\Exceptions\Console\ArgumentsNotGivenException;
use Html\Parser\Exceptions\Console\Command\CommandDoesNotImplementException;
use ReflectionClass;
use ReflectionException;

class Kernel
{
    private array $commands = [
        ParserCommand::class
    ];

    /**
     * @throws ReflectionException
     * @throws CommandDoesNotImplementException
     * @throws ArgumentsNotGivenException
     */
    public function boot(): void
    {
        foreach ($this->commands as $command) {
            $reflectionClass = new ReflectionClass($command);

            if (!in_array(Command::class, $reflectionClass->getInterfaceNames())) {
                throw new CommandDoesNotImplementException();
            }

            /** @var Command $commandObject */
            $commandObject = new $command();

            if ($this->getInputParameter() !== $commandObject->getParameter()) {
                continue;
            }

            if (!isset($this->getInputFlags()[$commandObject->getFlag()])) {
                throw new ArgumentsNotGivenException();
            }

            $commandObject->setFlags($this->getInputFlags());
            $commandObject->handle();
            break;
        }
    }

    private function getInputParameter(): ?string
    {
        return $this->getInputArguments()[1] ?? null;
    }

    private function getInputArguments(): array
    {
        return $_SERVER['argv'];
    }

    private function getInputFlags(): array
    {
        $input = $this->getInputArguments();
        array_shift($input);
        array_shift($input);

        $flags = [];
        foreach ($input as $flag) {
            preg_match("/\-\-(?'arg'.*)\=(?'value'.*)/", $flag, $matches);

            $flags[$matches['arg']] = $matches['value'];
        }

        return $flags;
    }
}