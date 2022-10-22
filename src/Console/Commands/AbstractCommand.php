<?php

namespace Html\Parser\Console\Commands;

abstract class AbstractCommand implements Command
{
    protected array $flags;

    public function getParameter(): ?string
    {
        return explode(' ', $this->getCommand())[0] ?? null;
    }

    public function getCommand(): string
    {
        return $this->command;
    }

    public function getFlag(): ?string
    {
        preg_match("/{\-\-(?'arg'.*)\=}/", $this->getCommand(), $match);

        return $match['arg'] ?? null;
    }

    public function setFlags(array $flags): void
    {
        $this->flags = $flags;
    }

    protected function get(string $flag): string
    {
        return $this->flags[$flag];
    }
}
