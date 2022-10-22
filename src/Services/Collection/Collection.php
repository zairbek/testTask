<?php

namespace Html\Parser\Services\Collection;

class Collection
{
    public function __construct(array $collection = [])
    {
        $this->items = $collection;
    }

    public function map(callable $callback): self
    {
        $this->items = array_map($callback, $this->items);

        return $this;
    }

    public function append(mixed $item): self
    {
        $this->items[] = $item;

        return $this;
    }

    public function notNull(): self
    {
        $newItems = [];
        foreach ($this->items as $item) {
            if (!is_null($item)) {
                $newItems[] = $item;
            }
        }

        $this->items = $newItems;

        return $this;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function groupBy(callable $callback): self
    {
        $group = [];
        foreach ($this->items as $item) {
            $group[$callback($item)][] = $item;
        }

        $items = array_values($group);
        foreach ($items as &$item) {
            $item = new self($item);
        }

        $this->items = $items;

        return $this;
    }

    public function first(): mixed
    {
        return $this->items[0] ?? null;
    }
}