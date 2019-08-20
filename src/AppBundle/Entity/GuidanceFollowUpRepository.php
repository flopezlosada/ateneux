<?php

namespace AppBundle\Entity;

/**
 * GuidanceFollowUpRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GuidanceFollowUpRepository extends \Doctrine\ORM\EntityRepository
{
    public function findStudentGuidance($student)
    {
         $em = $this->getEntityManager();
        $dql = "select t from AppBundle:GuidanceFollowUp t where t.course=:course and t.student=:student";

        $query = $em->createQuery($dql);
        $query->setParameter("course", $student->getCourse());
        $query->setParameter("student", $student);

        if (count($query->getResult())){
            return $query->getSingleResult();
        }

        return null;

    }
}
