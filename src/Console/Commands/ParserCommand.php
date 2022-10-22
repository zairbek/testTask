<?php

namespace Html\Parser\Console\Commands;

use Html\Parser\Actions\CountTagAction;

class ParserCommand extends AbstractCommand
{
    protected string $command = 'parse {--url=}';

    public function handle(): void
    {
        $result = (new CountTagAction())->run($this->get('url'));

        $result->map(function ($item) {
            echo $item['tag']->tagName . ' - ' . $item['count'] . PHP_EOL;
        });
    }
}
