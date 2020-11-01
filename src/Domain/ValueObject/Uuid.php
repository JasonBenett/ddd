<?php

declare(strict_types=1);

namespace JasonBenett\DDD\Domain\ValueObject;

use JasonBenett\DDD\Domain\ValueObject\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid as RamseyUuid;
use Ramsey\Uuid\UuidInterface;

class Uuid
{
    protected UuidInterface $value;

    public function __construct(?string $value = null)
    {
        if (null !== $value && !RamseyUuid::isValid($value)) {
            throw new InvalidUuidStringException($value);
        }

        $this->value = !empty($value) ? RamseyUuid::fromString($value) : RamseyUuid::uuid4();
    }

    public function getValue(): string
    {
        return $this->value->toString();
    }

    public function equals(self $uuid): bool
    {
        return $this->value->equals(RamseyUuid::fromString($uuid->getValue()));
    }
}