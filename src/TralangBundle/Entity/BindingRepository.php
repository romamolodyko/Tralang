<?php

namespace TralangBundle\Entity;

use Doctrine\ORM\EntityRepository;
use TralangBundle\DQL;

class BindingRepository extends EntityRepository
{
    public function getRandomEntities($count = 5, $id_user)
    {
        return  $this->createQueryBuilder('q')
            ->addSelect('RAND() as HIDDEN rand')
            ->where('q.id_user = :id_user')
            ->addOrderBy('rand')
            ->setParameter('id_user', $id_user)
            ->setMaxResults($count)
            ->getQuery()
            ->getArrayResult();
            //getResult();
    }

    public function getRandomOtherEntities($count = 5, $id_user, $id_words)
    {
        return  $this->createQueryBuilder('q')
            ->addSelect('RAND() as HIDDEN rand')
            ->where('q.id_user = :id_user')
            ->andWhere('q.id_word != :id_word')
            ->addOrderBy('rand')
            ->setParameters([
                            'id_user' => $id_user,
                            'id_word' => $id_words
                            ])
            ->setMaxResults($count)
            ->getQuery()
            ->getArrayResult();
        //getResult();
    }
}