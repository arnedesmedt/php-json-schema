<?php
/**
 * This file is part of event-engine/php-json-schema.
 * (c) 2018-2021 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace EventEngine\JsonSchema\Type;

use EventEngine\JsonSchema\AnnotatedType;
use EventEngine\JsonSchema\Type;
use EventEngine\Schema\PayloadSchema;

final class AnyType implements AnnotatedType, PayloadSchema
{
    use HasAnnotations;
    /**
     * Array representation of the schema
     */
    public function toArray(): array
    {
        return array_merge([], $this->annotations());
    }

    public function asNullable(): Type
    {
        return $this;
    }
}
