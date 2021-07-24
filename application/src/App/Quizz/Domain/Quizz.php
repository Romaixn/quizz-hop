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

    public static function create(UuidInterface $uuid, UuidInterface $creator, string $name, string $description, int $players, bool $isPrivate, \DateTime $updatedAt): self
    {
        $instance = new self();

        $instance->apply(new QuizzWasCreated($uuid, $creator, $name, $description, $players, $isPrivate, $updatedAt));

        return $instance;
    }

    public function applyQuizzWasCreated(QuizzWasCreated $event)
    {
        $this->uuid = $event->uuid;
        $this->creator = $event->creator;
        $this->name = $event->name;
        $this->description = $event->description;
        $this->players = $event->players;
        $this->isPrivate = $event->isPrivate;
        $this->updatedAt = $event->updatedAt;
    }

    public function getAggregateRootId(): string
    {
        return $this->uuid->toString();
    }

    public function name(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function players(): int
    {
        return $this->players;
    }

    public function setPlayers(int $players): self
    {
        $this->players = $players;

        return $this;
    }

    public function isPrivate(): bool
    {
        return $this->isPrivate;
    }

    public function setIsPrivate(bool $isPrivate): self
    {
        $this->isPrivate = $isPrivate;

        return $this;
    }

    public function slug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
