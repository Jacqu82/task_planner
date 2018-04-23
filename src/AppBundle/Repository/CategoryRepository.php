<?php

namespace AppBundle\Repository;

class CategoryRepository extends \Doctrine\ORM\EntityRepository
{
    public function findCategoryByUser($user)
    {
//        dump($user->getId()); die;

        return $this->createQueryBuilder('c')
            ->join('c.user', 'u')
            ->andWhere('u.id = :user')
            ->setParameter('user', $user->getId());
    }
}
