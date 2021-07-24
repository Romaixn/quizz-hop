<?php

declare(strict_types=1);

namespace App\Quizz\Infrastructure\ReadModel\Projections;

use App\Quizz\Domain\Event\QuizzWasCreated;
use Broadway\ReadModel\Projector;
use Assert\AssertionFailedException;
use App\Shared\Domain\Exception\DateTimeException;
use App\Quizz\Infrastructure\ReadModel\Mysql\MysqlReadModelQuizzRepository;
use App\Quizz\Infrastructure\ReadModel\QuizzView;

final class QuizzProjectionFactory extends Projector
{
    private MysqlReadModelQuizzRepository $repository;

    public function __construct(MysqlReadModelQuizzRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws AssertionFailedException
     * @throws DateTimeException
     */
    protected function applyQuizzWasCreated(QuizzWasCreated $quizzWasCreated): void
    {
        $quizzReadModel = QuizzView::fromSerializable($quizzWasCreated);

        $this->repository->add($quizzReadModel);
    }
}
