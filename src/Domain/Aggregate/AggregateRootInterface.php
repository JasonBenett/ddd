<?php

declare(strict_types=1);

namespace JasonBenett\DDD\Domain\Aggregate;

use JasonBenett\DDD\Domain\ValueObject\Uuid;

interface AggregateRootInterface
{
    public function getAggregateRootId(): Uuid;
}