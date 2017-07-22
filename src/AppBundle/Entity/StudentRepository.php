<?php

namespace AppBundle\Entity;

/**
 * StudentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StudentRepository extends \Doctrine\ORM\EntityRepository
{

    public function findMeetings($student_id, $meeting_status_id = null)
    {

        $em = $this->getEntityManager();
        $dql = "select t from AppBundle:Meeting t where t.student_meeting=:student ";
        if ($meeting_status_id) {
            $dql .= " and t.meeting_status=:status ";
        }

        $query = $em->createQuery($dql);
        $query->setParameter("student", $student_id);
        if ($meeting_status_id) {
            $query->setParameter("status", $meeting_status_id);
        }


        return $query->getResult();
    }

}
