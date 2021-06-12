<?php

declare(strict_types=1);

namespace App\Quizz\Domain;

use Ramsey\Uuid\UuidInterface;
use App\User\Domain\Event\QuizzWasCreated;
use Broadway\EventSourcing\EventSourcedAggregateRoot;

class Quizz extends EventSourcedAggregateRoot
{
    private $uuid;

    private $creator;

    private string $name;

    private string $description;

    private int $players;

    private string $slug;

    private bool $isPrivate;

    private \DateTime $updatedAt;

    public static function create(UuidInterface $uuid, UuidInterface $creator, \DateTime $date): self
    {
        $instance = new self();

        $instance->apply(new QuizzWasCreated($uuid, $creator, $date));

        return $instance;
    }

    public function applyQuizzWasCreated()
    {
    }

    public function getAggregateRootId(): string
    {
        return $this->uuid->toString();
    }
}
