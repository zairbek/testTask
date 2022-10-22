<?php

namespace Html\Parser\Exceptions\Console\Command;

use Exception;

class CommandDoesNotImplementException extends Exception
{
    protected $message = 'Command does not implement the Command class';
}