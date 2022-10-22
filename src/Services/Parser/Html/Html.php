<?php

namespace Html\Parser\Services\Parser\Html;

use Html\Parser\Services\Collection\Collection;

class Html
{
    private Collection $tags;

    public static function parseFromString(string $html)
    {
        preg_match_all('/<[^>]*>/', $html, $match);

        $self = new self();

        $self->tags = new Collection();

        foreach ($match as $items) {
            foreach ($items as $tagString) {
                preg_match("/<(?'tag'!?\w*).*>/", $tagString, $match);

                if (isset($match['tag']) && !empty($match['tag'])) {
                    $self->tags->append(new Tag($match['tag']));
                }
            }
        }

        return $self;
    }

    public function getTag(string $tagName): Collection
    {
        return $this->tags->map(function (Tag $tag) use ($tagName) {
            if ($tag->tagName === $tagName) {
                return $tag;
            }
        })->notNull();
    }

    public function getTags()
    {
        return $this->tags->groupBy(function (Tag $tag) {
            return $tag->tagName;
        });
    }
}