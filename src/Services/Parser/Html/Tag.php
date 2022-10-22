<?php

namespace Html\Parser\Services\Parser\Html;

class Tag
{
    public function __construct(
        public readonly string $tagName
    )
    {
    }
}