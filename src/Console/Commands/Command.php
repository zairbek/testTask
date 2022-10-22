<?php

namespace Html\Parser\Console\Commands;

interface Command
{
    public function getCommand(): string;

    public function getParameter(): ?string;

    public function getFlag(): ?string;

    public function setFlags(array $flags): void;

    public function handle(): void;
}
