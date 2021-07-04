<?php

declare(strict_types=1);

namespace App\Quizz\Domain\Event;

use Broadway\Serializer\Serializable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class QuizzWasCreated implements Serializable
{
    public function __construct(public UuidInterface $uuid, public UuidInterface $creator, public string $name, public string $description, public int $players, public bool $isPrivate, public \DateTime $updatedAt)
    {
    }

    public function serialize(): array
    {
        return [
            'uuid' => $this->uuid->toString(),
            'creator' => $this->creator->toString(),
            'name' => $this->name,
            'description' => $this->description,
            'players' => $this->players,
            'isPrivate' => $this->isPrivate,
            'updatedAt' => $this->updatedAt->format('Y-m-d H:i:s')
        ];
    }

    public static function deserialize(array $data)
    {
        return new self(
            Uuid::fromString($data['uuid']),
            Uuid::fromString($data['creator']),
            $data['name'],
            $data['description'],
            $data['players'],
            $data['isPrivate'],
            new \DateTime($data['updatedAt'])
        );
    }
}
