<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
/**
 * Student controller.
 *
 */
class StudentController extends Controller
{
    /**
     * Lists all student entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();


        $students = $em->getRepository('AppBundle:Student')->findAll();

        return $this->render('student/index.html.twig', array(
            'students' => $students,
        ));
    }

    /**
     * Creates a new student entity.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $student = new Student();
        $form = $this->createForm('AppBundle\Form\StudentType', $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($student);
            $em->flush();

            return $this->redirectToRoute('student_show', array('id' => $student->getId()));
        }

        return $this->render('student/new.html.twig', array(
            'student' => $student,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a student entity.
     *
     */
    public function showAction(Student $student)
    {
        $deleteForm = $this->createDeleteForm($student);

        return $this->render('student/show.html.twig', array(
            'student' => $student,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing student entity.
     *
     */
    public function editAction(Request $request, Student $student)
    {
        $deleteForm = $this->createDeleteForm($student);
        $editForm = $this->createForm('AppBundle\Form\StudentType', $student);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('student_edit', array('id' => $student->getId()));
        }

        return $this->render('student/edit.html.twig', array(
            'student' => $student,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a student entity.
     *
     */
    public function deleteAction(Request $request, Student $student)
    {
        $form = $this->createDeleteForm($student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($student);
            $em->flush();
        }

        return $this->redirectToRoute('student_index');
    }

    /**
     * Creates a form to delete a student entity.
     *
     * @param Student $student The student entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Student $student)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('student_delete', array('id' => $student->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }


    public function courseAction($student_id)
    {
        $em = $this->getDoctrine()->getManager();

        $student = $em->getRepository('AppBundle:Student')->find($student_id);
        $courses = $em->getRepository('AppBundle:Course')->findCoursesStatus(1);//encuentra cursos activos

        return $this->render('student/courses.html.twig', array(
            'student' => $student,
            'courses' => $courses
        ));
    }

    public function courseSelectedAction($course_id, $student_id)
    {
        $em = $this->getDoctrine()->getManager();

        $student = $em->getRepository('AppBundle:Student')->find($student_id);
        $course = $em->getRepository('AppBundle:Course')->find($course_id);

        $student->setCourse($course);
        $em->persist($student);
        $em->flush();

        $securityContext = $this->get('security.authorization_checker');
        if( $securityContext->isGranted('ROLE_TEACHER') )
        {
            return $this->redirectToRoute('course_show', array('id' => $this->getUser()->getTeacher()->getMentorCourse()->getId()));
        }

        return $this->redirectToRoute('student_show', array('id' => $student->getId()));


    }
}
