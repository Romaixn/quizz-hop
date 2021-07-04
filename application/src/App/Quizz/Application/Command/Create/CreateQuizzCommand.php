<?php

namespace App\Quizz\Application\Command\Create;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class CreateQuizzCommand
{
    /**
     * @var UuidInterface
     */
    public $uuid;

    /**
     * @var UuidInterface
     */
    public $owner;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $description;

    /**
     * @var int
     */
    public $players;

    /**
     * @var bool
     */
    public $isPrivate;

    /**
     * @var \DateTime
     */
    public $updatedAt;

    public function __construct(string $uuid, string $owner, string $name, string $description, int $players, bool $isPrivate, \DateTime $updatedAt)
    {
        $this->uuid = Uuid::fromString($uuid);
        $this->owner = Uuid::fromString($owner);
        $this->name = $name;
        $this->description = $description;
        $this->players = $players;
        $this->isPrivate = $isPrivate;
        $this->updatedAt = $updatedAt;
    }
}
