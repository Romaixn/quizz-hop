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
     * @var \DateTime
     */
    public $updatedAt;

    public function __construct(string $uuid, string $owner, \DateTime $updatedAt)
    {
        $this->uuid = Uuid::fromString($uuid);
        $this->owner = Uuid::fromString($owner);
        $this->updatedAt = $updatedAt;
    }
}
