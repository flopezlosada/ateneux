<?php

namespace AppBundle\Entity;

/**
 * MediationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MediationRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByCourseType($type,$school_year)
    {


        $em = $this->getEntityManager();
        $dql = "select count(m) from AppBundle:Mediation m where m.course_first_student in (:courses) 
              or  m.course_second_student in (:courses)";

        $query = $em->createQuery($dql);
        $query->setParameter("courses", $this->getCourseTypesIds($type,$school_year));

        return $query->getSingleScalarResult();
    }


    private function getCourseTypesIds($type,$school_year)
    {
        $em = $this->getEntityManager();

        $dql_courses = "select c from AppBundle:Course c where c.school_year=:school_year and c.course_type=:type";
        $query_courses = $em->createQuery($dql_courses);
        $query_courses->setParameter("school_year", $school_year);
        $query_courses->setParameter("type", $type);

        $result_courses = $query_courses->getResult();
        $int = array();
        foreach ($result_courses as $course) {
            $int[] = $course->getId();
        }

        return $int;
    }

    private function getActiveCourseIds()
    {
        $em = $this->getEntityManager();

        $dql_courses = "select c from AppBundle:Course c where c.course_status=:course_status";
        $query_courses = $em->createQuery($dql_courses);
        $query_courses->setParameter("course_status", 1);

        $result_courses = $query_courses->getResult();
        $int = array();
        foreach ($result_courses as $course) {
            $int[] = $course->getId();
        }

        return $int;
    }


    public function findByCourseTypeMonth($type, $month,$school_year)
    {
        $em = $this->getEntityManager();
        $dql = "select count(m) from AppBundle:Mediation m
              where (m.course_first_student in (:courses) or  m.course_second_student in (:courses)) 
              and MONTH(m.date)=:month order by m.date asc";

        $query = $em->createQuery($dql);
        $query->setParameter("courses", $this->getCourseTypesIds($type,$school_year));
        $query->setParameter("month", $month);

        return $query->getSingleScalarResult();
    }

    public function findByMonth($month)
    {
        $em = $this->getEntityManager();
        $dql = "select count(m) as total  from AppBundle:Mediation m
              where (m.course_first_student in (:courses) or  m.course_second_student in (:courses)) and MONTH(m.date)=:month order by m.date asc";

        $query = $em->createQuery($dql);
        $query->setParameter("courses", $this->getActiveCourseIds());
        $query->setParameter("month", $month);

        return $query->getSingleScalarResult();
    }

    public function findAllMediationsByCourse()
    {
        $em = $this->getEntityManager();
        $dql = "select count(m) as total  from AppBundle:Mediation m
              where (m.course_first_student in (:courses) or  m.course_second_student in (:courses))";

        $query = $em->createQuery($dql);
        $query->setParameter("courses", $this->getActiveCourseIds());


        return $query->getSingleScalarResult();
    }

    public function findByStudentCourse($student, $selected_course)
    {
        $em = $this->getEntityManager();
        $dql = "Select m from AppBundle:Mediation m where (m.first_student=:student and m.course_first_student=:course) 
                or (m.second_student=:student and m.course_second_student=:course) order by m.date desc";

        $query = $em->createQuery($dql);
        $query->setParameter("student", $student);
        $query->setParameter("course", $selected_course);

        return $query->getResult();

    }

    public function findByMediatorCourse($student, Course $selected_course)
    {
        $em = $this->getEntityManager();
        $dql = "Select m from AppBundle:Mediation m where m.student_mediator=:student and
         m.date   BETWEEN :start and :end  
        order by m.date desc";

        $query = $em->createQuery($dql);
        $query->setParameter("student", $student);

        $query->setParameter('start', $selected_course->getStartDate());
        $query->setParameter('end', $selected_course->getEndDate());


        return $query->getResult();

    }
}
