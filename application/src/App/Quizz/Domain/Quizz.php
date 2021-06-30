<?php

declare(strict_types=1);

namespace App\Quizz\Domain;

use Ramsey\Uuid\UuidInterface;
use App\Quizz\Domain\Event\QuizzWasCreated;
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

    public static function create(UuidInterface $uuid, UuidInterface $creator, \DateTime $updatedAt): self
    {
        $instance = new self();

        $instance->apply(new QuizzWasCreated($uuid, $creator, $updatedAt));

        return $instance;
    }

    public function applyQuizzWasCreated(QuizzWasCreated $event)
    {
        $this->uuid = $event->uuid;
        $this->creator = $event->creator;
        $this->updatedAt = $event->updatedAt;
    }

    public function getAggregateRootId(): string
    {
        return $this->uuid->toString();
    }
}
