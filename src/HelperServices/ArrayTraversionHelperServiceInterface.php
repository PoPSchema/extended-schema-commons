<?php

declare(strict_types=1);

namespace PoPSchema\ExtendedSchemaCommons\HelperServices;

use PoP\Engine\Exception\RuntimeOperationException;
use stdClass;

interface ArrayTraversionHelperServiceInterface
{
    /**
     * @return mixed[]
     * @throws RuntimeOperationException If the path cannot be reached under the array, or if its value is not an array
     * @param array<string|int,mixed> $data
     */
    public function &getPointerToArrayItemUnderPath(array &$data, int|string $path): array;
    /**
     * @throws RuntimeOperationException If the path cannot be reached under the array
     * @param array<string|int,mixed>|stdClass $data
     */
    public function &getPointerToElementItemUnderPath(array|stdClass &$data, int|string $path): mixed;
    /**
     * @throws RuntimeOperationException If the path cannot be reached under the array
     * @param array<string|int,mixed>|stdClass $data
     */
    public function setValueToArrayItemUnderPath(array|stdClass &$data, int|string $path, mixed $value): void;
}
