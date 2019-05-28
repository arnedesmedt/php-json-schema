<?php
declare(strict_types=1);

namespace EventEngineTest\JsonSchema\Stub;

use EventEngine\JsonSchema\JsonSchemaAwareCollection;
use EventEngine\JsonSchema\JsonSchemaAwareCollectionLogic;

final class ScalarPropsRecordAllowNestedCollection implements JsonSchemaAwareCollection
{
    use JsonSchemaAwareCollectionLogic;

    private static function __itemType(): ?string
    {
        return ScalarPropsRecord::class;
    }

    private static function __allowNestedSchema(): bool
    {
        return true;
    }

    /**
     * @var ScalarPropsRecord[]
     */
    private $items;

    public static function fromArray(array $items): self
    {
        return new self(...array_map(function (array $item) {
            return ScalarPropsRecord::fromArray($item);
        }, $items));
    }

    public static function fromItems(ScalarPropsRecord ...$items): self
    {
        return new self(...$items);
    }

    public static function emptyList(): self
    {
        return new self();
    }

    private function __construct(ScalarPropsRecord ...$items)
    {
        $this->items = $items;
    }

    public function push(ScalarPropsRecord $item): self
    {
        $copy = clone $this;
        $copy->items[] = $item;
        return $copy;
    }

    public function pop(): self
    {
        $copy = clone $this;
        \array_pop($copy->items);
        return $copy;
    }

    public function first(): ?ScalarPropsRecord
    {
        return $this->items[0] ?? null;
    }

    public function last(): ?ScalarPropsRecord
    {
        if (count($this->items) === 0) {
            return null;
        }

        return $this->items[count($this->items) - 1];
    }

    public function contains(ScalarPropsRecord $item): bool
    {
        foreach ($this->items as $existingItem) {
            if ($existingItem->equals($item)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return ScalarPropsRecord[]
     */
    public function items(): array
    {
        return $this->items;
    }

    public function toArray(): array
    {
        return \array_map(function (ScalarPropsRecord $item) {
            return $item->toArray();
        }, $this->items);
    }

    public function equals($other): bool
    {
        if (!$other instanceof self) {
            return false;
        }

        return $this->toArray() === $other->toArray();
    }

    public function __toString(): string
    {
        return \json_encode($this->toArray());
    }
}
