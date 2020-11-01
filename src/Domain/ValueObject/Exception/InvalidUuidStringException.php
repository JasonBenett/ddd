<?php

declare(strict_types=1);

namespace JasonBenett\DDD\Domain\ValueObject\Exception;

use Ramsey\Uuid\Exception\InvalidUuidStringException as RamseyException;
use Throwable;

class InvalidUuidStringException extends RamseyException
{
    public function __construct(string $value)
    {
        parent::__construct(sprintf('Invalid UUID string given.'));
    }
}
