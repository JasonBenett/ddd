<?php

declare(strict_types=1);

namespace JasonBenet\DDD\Tests\Domain\ValueObject;

use JasonBenett\DDD\Domain\ValueObject\Exception\InvalidUuidStringException;
use JasonBenett\DDD\Domain\ValueObject\Uuid;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid as RamseyUuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @coversDefaultClass \JasonBenett\DDD\Domain\ValueObject\Uuid
 */
class UuidTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getValue
     * @dataProvider valueProvider
     */
    public function testValue(?string $expectedValue, bool $isValid): void
    {
        if (!$isValid) {
            $this->expectException(InvalidUuidStringException::class);
        }

        $sut   = new Uuid($expectedValue);
        $value = $sut->getValue();

        if ($isValid) {
            self::assertTrue(RamseyUuid::isValid($value));

            if (null !== $expectedValue) {
                self::assertSame($expectedValue, $value);
            }
        }
    }

    /**
     * @covers ::equals
     * @dataProvider valueProvider
     */
    public function testEquality(): void
    {
        $relevantValue = '132779ae-c91b-440b-9452-e8b29d75b74a';

        $sut   = new Uuid($relevantValue);
        $uuid  = new Uuid($relevantValue);
        $uuid2 = new Uuid('91380979-edd8-487c-b579-1e1d98e8dcab');

        self::assertTrue($sut->equals($uuid));
        self::assertFalse($sut->equals($uuid2));
    }

    public function valueProvider(): array
    {
        return [
            [null, true],
            ['132779ae-c91b-440b-9452-e8b29d75b74a', true],
            ['', false],
        ];
    }
}