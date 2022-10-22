<?php

namespace Html\Parser\Actions;


use Html\Parser\Services\Collection\Collection;
use Html\Parser\Services\Http\Http;
use Html\Parser\Services\Parser\Html\Html;

class CountTagAction
{
    public function run(string $url)
    {
        $response = (new Http())->get($url);

        $html = Html::parseFromString($response);

        return $html->getTags()->map(function (Collection $items) {
            return [
                'tag' => $items->first(),
                'count' => $items->count()
            ];
        });
    }
}