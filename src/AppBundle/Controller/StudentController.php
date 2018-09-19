<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;

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
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_JEFATURA')")
     */
    public function newAction(Request $request)
    {
        $student = new Student();
        $form = $this->createForm('AppBundle\Form\StudentType', $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $student->setBirthDate(new \DateTime($student->getBirthDate())) ;
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

    public function promoteAction(Student $student)
    {
        $em = $this->getDoctrine()->getManager();


        return $this->render('student/promote.html.twig', array(
            'student' => $student,
        ));
    }

    /**
     * Finds and displays a student entity.
     *
     */
    public function showAction(Student $student)
    {
        $deleteForm = $this->createDeleteForm($student);
        $em = $this->getDoctrine()->getManager();
        $pending_student_meetings = $em->getRepository('AppBundle:Student')
            ->findMeetings($student->getId(), 1);//encuentra reuniones pendientes (1)

        $student_meetings = $em->getRepository('AppBundle:Student')
            ->findMeetings($student->getId());//todas las reuniones que ha tenido el estudiante

        $student_warnings = $em->getRepository('AppBundle:Student')
            ->findWarnings($student->getId());//todas las amonestaciones y partes que ha tenido el estudiante

        //busca que haya información sobre el estudiante para la reunión
        $academic_informations = $em->getRepository("AppBundle:AcademicInformation")->findRealInformation($student);
        $assessment_board_learning_difficulties=null;
        $learning_difficulties=null;
        foreach ($student->getCourse()->getAssessmentsBoard() as $assessment_board)
        {

            $learning_difficulties=$em->getRepository("AppBundle:Student")->getDifficulties($student->getCourse(),$student,$assessment_board);
            $assessment_board_learning_difficulties[]=array($assessment_board,$learning_difficulties);
        }



        return $this->render('student/show.html.twig', array(
            'student' => $student,
            'pending_student_meetings' => $pending_student_meetings,
            'student_meetings' => $student_meetings,
            'student_warnings' => $student_warnings,
            'delete_form' => $deleteForm->createView(),
            'academic_informations' => $academic_informations,
            'assessment_board_learning_difficulties'=>$assessment_board_learning_difficulties,
            'learning_difficulties'=>$learning_difficulties,
        ));
    }

    /**
     * Displays a form to edit an existing student entity.
     *
     */
    public function editAction(Request $request, Student $student)
    {
        $deleteForm = $this->createDeleteForm($student);
        Date($student->getBirthDate()->format('Y-m-d')) ;
        $editForm = $this->createForm('AppBundle\Form\StudentType', $student);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $student->setBirthDate(new \DateTime($student->getBirthDate())) ;
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('student_show', array('id' => $student->getId()));
        }

        return $this->render('student/edit.html.twig', array(
            'student' => $student,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function familiarPdfAction($student_id)
    {

        $em = $this->getDoctrine()->getManager();

        $student = $em->getRepository('AppBundle:Student')->find($student_id);

        $html = $this->renderView(':student:familiar.html.twig', array(
            'student' => $student
        ));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml(utf8_decode($html)),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="familiar_' . $student->__toString() . '.pdf"'
            )
        );
    }

    public function generateSchoolAction($student_id, $type)
    {
        $em = $this->getDoctrine()->getManager();

        $student = $em->getRepository('AppBundle:Student')->find($student_id);

        $html = $this->renderView(':student:school.html.twig', array(
            'student' => $student
        ));

        if ($type == "pdf") {
            return new Response(
                $this->get('knp_snappy.pdf')->getOutputFromHtml(utf8_decode($html)),
                200,
                array(
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'attachment; filename="school' . $student->__toString() . '.pdf"'
                )
            );
        } elseif ($type == 'image') {
            return new Response(
                $this->get('knp_snappy.image')->getOutputFromHtml(utf8_decode($html)),
                200,
                array(
                    'Content-Type' => 'image/jpg',
                    'Content-Disposition' => 'filename="school' . $student->__toString() . '.jpg"'
                )
            );
        }

    }

    /**
     * Deletes a student entity.
     *
     */
    public function deleteAction(Request $request, Student $student)
    {
        $form = $this->createDeleteForm($student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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

    /**
     * @param $student_id
     * @return Response
     *  @Security("has_role('ROLE_ADMIN') or has_role('ROLE_JEFATURA')")
     */
    public function courseAction($student_id)
    {
        $em = $this->getDoctrine()->getManager();

        $student = $em->getRepository('AppBundle:Student')->find($student_id);
        $courses = $em->getRepository('AppBundle:Course')->findCoursesStatusUnity(1,$student);//encuentra cursos activos

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
        if ($securityContext->isGranted('ROLE_TEACHER')) {
            return $this->redirectToRoute('course_show', array('id' => $this->getUser()->getTeacher()->getMentorCourse()->getId()));
        }

        return $this->redirectToRoute('student_show', array('id' => $student->getId()));


    }
}
