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

    private $creator;

    private string $name;

    private string $description;

    private int $players;

    private string $slug;

    private bool $isPrivate;

    private ?DateTime $updatedAt;

    private function __construct(
        UuidInterface $uuid,
        string $name,
        string $description,
        int $players,
        bool $isPrivate,
        ?DateTime $updatedAt
    ) {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->description = $description;
        $this->players = $players;
        $this->isPrivate = $isPrivate;
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
     * @return QuizzView
     */
    public static function deserialize(array $data): self
    {
        return new self(
            Uuid::fromString($data['uuid']),
            $data['name'],
            $data['description'],
            $data['players'],
            $data['isPrivate'],
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
