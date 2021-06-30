<?php

declare(strict_types=1);

namespace App\Quizz\Domain\Repository;

use App\Quizz\Domain\Quizz;
use Ramsey\Uuid\UuidInterface;

interface QuizzRepositoryInterface
{
    public function get(UuidInterface $uuid): Quizz;

    public function store(Quizz $quizz): void;
}
