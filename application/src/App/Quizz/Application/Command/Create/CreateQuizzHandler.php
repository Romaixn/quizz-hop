<?php

namespace App\Quizz\Application\Command\Create;

use App\Quizz\Domain\Quizz;
use App\Quizz\Domain\Repository\QuizzRepositoryInterface;
use App\Shared\Application\Command\CommandHandlerInterface;

class CreateQuizzHandler implements CommandHandlerInterface
{
    /**
     * @var QuizzRepositoryInterface
     */
    private $repository;

    public function __construct(QuizzRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CreateQuizzCommand $command)
    {
        $quizz = Quizz::create($command->uuid, $command->creator, $command->updatedAt);

        $this->repository->store($quizz);
    }
}
