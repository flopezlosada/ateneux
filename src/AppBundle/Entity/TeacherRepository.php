<?php

namespace AppBundle\Entity;

/**
 * TeacherRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TeacherRepository extends \Doctrine\ORM\EntityRepository
{
    public function findEmailCreated($email)
    {
        $em=$this->getEntityManager();
        $dql="SELECT u FROM AppBundle:Teacher u WHERE u.email LIKE :email";
        $query = $em->createQuery($dql);
        $query->setParameter('email', $email);

        return $query->getOneOrNullResult();
    }
}
