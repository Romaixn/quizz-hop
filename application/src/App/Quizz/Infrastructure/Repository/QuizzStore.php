<?php

declare(strict_types=1);

namespace App\Quizz\Infrastructure\Repository;

use App\Quizz\Domain\Quizz;
use Ramsey\Uuid\UuidInterface;
use Broadway\EventStore\EventStore;
use Broadway\EventHandling\EventBus;
use Broadway\EventSourcing\EventSourcingRepository;
use App\Quizz\Domain\Repository\QuizzRepositoryInterface;
use Broadway\EventSourcing\AggregateFactory\PublicConstructorAggregateFactory;

final class QuizzStore extends EventSourcingRepository implements QuizzRepositoryInterface
{
    public function __construct(
        EventStore $eventStore,
        EventBus $eventBus,
        array $eventStreamDecorators = []
    ) {
        parent::__construct(
            $eventStore,
            $eventBus,
            Quizz::class,
            new PublicConstructorAggregateFactory(),
            $eventStreamDecorators
        );
    }

    public function store(Quizz $quizz): void
    {
        $this->save($quizz);
    }

    public function get(UuidInterface $uuid): Quizz
    {
        /** @var Quizz $quizz */
        $quizz = $this->load($uuid->toString());

        return $quizz;
    }
}
