<?php


namespace AppBundle\Service;


use Doctrine\ORM\EntityManager;


class CourseStatus
{
    protected $em;
    private $container;

    // We need to inject this variables later.
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;

    }

    public function getStatusRealCourse($selected_course_id = null)
    {
        $dql = "select c from AppBundle:CourseActivationControl c where c.course=:course";
        $query = $this->em->createQuery($dql);
        if ($selected_course_id == "NULL") {

            $query->setParameter('course', RealCourse::getRealCourse());
        } else {

            $selected_course = $this->em->getRepository("AppBundle:Course")->find($selected_course_id);
            $query->setParameter('course', $selected_course->getRealYear());
        }

        $course_status = $query->getSingleResult();

        return $course_status->getStatus();
    }
}