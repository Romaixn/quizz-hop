<?php

declare(strict_types=1);

namespace App\Quizz\Infrastructure\ReadModel;

use App\Shared\Domain\Exception\DateTimeException;
use App\Shared\Domain\ValueObject\DateTime;
use Assert\AssertionFailedException;
use Broadway\ReadModel\SerializableReadModel;
use Broadway\Serializer\Serializable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @psalm-suppress MissingConstructor
 */
class QuizzView implements SerializableReadModel
{
    public const TYPE = 'QuizzView';

    private UuidInterface $uuid;

    private ?DateTime $updatedAt;

    private function __construct(
        UuidInterface $uuid,
        ?DateTime $updatedAt
    ) {
        $this->uuid = $uuid;
        $this->updatedAt = $updatedAt;
    }

    /**
     * @throws DateTimeException
     * @throws AssertionFailedException
     */
    public static function fromSerializable(Serializable $event): self
    {
        return self::deserialize($event->serialize());
    }

    /**
     * @throws DateTimeException
     * @throws AssertionFailedException
     *
     * @return UserView
     */
    public static function deserialize(array $data): self
    {
        return new self(
            Uuid::fromString($data['uuid']),
            DateTime::fromString($data['updated_at']),
        );
    }

    public function serialize(): array
    {
        return [
            'uuid' => $this->getId(),
        ];
    }

    public function uuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function changeUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getId(): string
    {
        return $this->uuid->toString();
    }
}
