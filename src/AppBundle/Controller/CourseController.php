<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Course;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Course controller.
 *
 */
class CourseController extends Controller
{
    /**
     * Lists all course entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $courses = $em->getRepository('AppBundle:Course')->findAll();

        return $this->render('course/index.html.twig', array(
            'courses' => $courses,
        ));
    }

    /**
     * Creates a new course entity.
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_JEFATURA')")
     */
    public function newAction(Request $request)
    {
        $course = new Course();
        $form = $this->createForm('AppBundle\Form\CourseType', $course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $course_status = $em->getRepository('AppBundle:CourseStatus')->find(1);
            $course->setCourseStatus($course_status);

            $em->persist($course);
            $course->setStartDate(new \DateTime($course->getStartDate()));
            $course->setEndDate(new \DateTime($course->getEndDate()));
            $em->persist($course);
            $em->flush();

            return $this->redirectToRoute('course_show', array('id' => $course->getId()));
        }

        return $this->render('course/new.html.twig', array(
            'course' => $course,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a course entity.
     *
     */
    public function showAction(Course $course)
    {
        $deleteForm = $this->createDeleteForm($course);

        return $this->render('course/show.html.twig', array(
            'course' => $course,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing course entity.
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_JEFATURA')")
     */
    public function editAction(Request $request, Course $course)
    {
        $deleteForm = $this->createDeleteForm($course);
        $course->setStartDate($course->getStartDate()->format('Y-m-d')) ;
        $course->setENdDate($course->getEndDate()->format('Y-m-d')) ;
        $editForm = $this->createForm('AppBundle\Form\CourseType', $course);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $course->setStartDate(new \DateTime($course->getStartDate())) ;
            $course->setEndDate(new \DateTime($course->getEndDate())) ;
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('course_show', array('id' => $course->getId()));
        }

        return $this->render('course/edit.html.twig', array(
            'course' => $course,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a course entity.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, Course $course)
    {
        $form = $this->createDeleteForm($course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($course);
            $em->flush();
        }

        return $this->redirectToRoute('course_index');
    }

    /**
     * Creates a form to delete a course entity.
     *
     * @param Course $course The course entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Course $course)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('course_delete', array('id' => $course->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * Displays a list of students with course_type like this course->course_type
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_JEFATURA')")
     */
    public function addStudentsAction(Course $course, Request $request)
    {
        $em = $this->getDoctrine()->getManager();


        $form = $this->createFormBuilder(null,array('validation_groups' => false))
            ->add('student', EntityType::class, array(
                'class' => 'AppBundle\Entity\Student',
                'expanded' => true,
                'multiple' => true,
                'query_builder' => function (EntityRepository $repository) use ($course)
                {
                    $qb = $repository->createQueryBuilder('t')
                        ->where('t.course is NULL')
                        ->andWhere("t.course_type=:course_type")
                        ->orderBy("t.surname, t.name", "ASC")
                        ->setParameter('course_type', $course->getCourseType());

                    return $qb;
                },
                'label' => 'Selecciona  las/los estudiantes que van a participar en este curso: ',
            ))
            ->add('send', SubmitType::class, array('label' => 'Aceptar'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted())
        {
            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();
            //dump($data);
            foreach ($data["student"] as $student_id)
            {
                //dump($student_id);
                $student=$em->getRepository("AppBundle:Student")->find($student_id->getId());
                $student->setCourse($course);
            }

            $em->persist($student);
            $em->flush();

            return $this->redirectToRoute('course_show', array('id' => $course->getId()));
        }

        return $this->render(':course:addstudents.html.twig', array(
            'form' => $form->createView(),
            'course' => $course

        ));

    }
}
