<?php

declare(strict_types=1);

namespace App\Quizz\Infrastructure\ReadModel\Mysql;

use App\Quizz\Infrastructure\ReadModel\QuizzView;
use App\Shared\Infrastructure\Persistence\ReadModel\Exception\NotFoundException;
use App\Shared\Infrastructure\Persistence\ReadModel\Repository\MysqlRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\QueryBuilder;
use Ramsey\Uuid\UuidInterface;

final class MysqlReadModelQuizzRepository extends MysqlRepository
{
    protected function setEntityManager(): void
    {
        /** @var EntityRepository $objectRepository */
        $objectRepository = $this->entityManager->getRepository(QuizzView::class);
        $this->repository = $objectRepository;
    }

    /**
     * @throws NotFoundException
     * @throws NonUniqueResultException
     */
    public function oneByUuid(UuidInterface $uuid): QuizzView
    {
        $qb = $this->repository
            ->createQueryBuilder('quizz')
            ->where('quizz.uuid = :uuid')
            ->setParameter('uuid', $uuid->getBytes())
        ;

        return $this->oneOrException($qb);
    }

    public function add(QuizzView $quizzRead): void
    {
        $this->register($quizzRead);
    }
}
