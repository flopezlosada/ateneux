<?php

namespace AppBundle\Entity;

use AppBundle\Service\RealCourse;

/**
 * CourseRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CourseRepository extends \Doctrine\ORM\EntityRepository
{
    public function findCoursesStatus($int)
    {
        $em = $this->getEntityManager();
        $dql = "select t from AppBundle:Course t where t.course_status=:status ORDER BY  t.course_type asc";

        $query = $em->createQuery($dql);
        $query->setParameter("status", $int);

        return $query->getResult();
    }


    /**
     * @param $int
     * @return mixed
     * Devuelve los cursos activos que corresponden con el nivel del estudiante
     */
    public function findCoursesStatusUnity($int, $type_id)
    {
        $em = $this->getEntityManager();
        $dql = "select t from AppBundle:Course t where t.course_status=:status and t.course_type in (:course_type) ORDER BY  t.course_type asc";

        $query = $em->createQuery($dql);
        $query->setParameter("status", $int);
        $query->setParameter("course_type", $type_id);

        return $query->getResult();
    }


    /**
     *
     */
    public function findRealCourses($year=null)
    {
        $em = $this->getEntityManager();
        $dql = "select c from AppBundle:Course c where c.course_status=:status and c.start_date>=:start_date and c.end_date<=:end_date";

        $query = $em->createQuery($dql);
        $query->setParameter("status", 1);
        $query->setParameter("start_date", RealCourse::getStartDateCourse($year));
        $query->setParameter("end_date", RealCourse::getEndDateCourse($year));

        return $query->getResult();

    }

    public function findCoursesList($school_year)
    {
        $em = $this->getEntityManager();
        $dql = "select t from AppBundle:Course t where t.school_year=:school_year";

        $query = $em->createQuery($dql);
        $query->setParameter("school_year", $school_year);


        return $query->getResult();
    }
}
