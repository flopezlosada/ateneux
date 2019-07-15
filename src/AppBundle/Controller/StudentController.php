<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Student;
use AppBundle\Service\CourseStatus;
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

    public function mediationFirstAction($student_id)
    {
        $em = $this->getDoctrine();
        $students = $em->getRepository("AppBundle:Student")->findAllActiveSorted();
        $first_student = $em->getRepository("AppBundle:Student")->find($student_id);

        return $this->render('student/mediation_first.html.twig', array(
            'students' => $students,
            'first_student' => $first_student
        ));
    }

    public function mediationSecondAction($first_student_id, $second_student_id)
    {
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
            $student->setBirthDate(new \DateTime($student->getBirthDate()));
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
    public function showAction(Student $student, $selected_course_id = null, CourseStatus $course_status)
    {

        $deleteForm = $this->createDeleteForm($student);
        $em = $this->getDoctrine()->getManager();


        $status_real_course=$course_status->getStatusRealCourse($selected_course_id);//devuelve 0,1,2 ó 3 según el estado del curso que se está analizando

        if ($student->getCourse()) {

            if ($selected_course_id == "NULL") {


                $selected_course = $student->getCourse();
            } else {
                $selected_course = $em->getRepository("AppBundle:Course")->find($selected_course_id);

            }

            $pending_student_meetings = $em->getRepository('AppBundle:Student')
                ->findMeetings($student->getId(), $selected_course,1);//encuentra reuniones pendientes (1)

            $student_meetings = $em->getRepository('AppBundle:Student')
                ->findMeetings($student->getId(),$selected_course);//todas las reuniones que ha tenido el estudiante

            $student_warnings = $em->getRepository('AppBundle:Student')
                ->findWarnings($student->getId(), $selected_course);//todas las amonestaciones y partes que ha tenido el estudiante para el curso actual.

            //busca que haya información sobre el estudiante para la reunión
            $academic_informations = $em->getRepository("AppBundle:AcademicInformation")->findRealInformation($student);
            $assessment_board_learning_difficulties = null;
            $learning_difficulties = null;


            foreach ($selected_course->getAssessmentsBoard() as $assessment_board) {

                $learning_difficulties = $em->getRepository("AppBundle:Student")->getDifficulties($selected_course, $student, $assessment_board);
                $assessment_board_learning_difficulties[] = array($assessment_board, $learning_difficulties);
            }
            $mediation_needed=$em->getRepository("AppBundle:Mediation")->findByStudentCourse($student,$selected_course);
            if ($student->getIsMediator()){
                $mediations_mediator=$em->getRepository("AppBundle:Mediation")->findByMediatorCourse($student,$selected_course);
            }
            else {
                $mediations_mediator=null;
            }


        } else {
            $pending_student_meetings = null;
            $student_meetings = null;
            $student_warnings = null;
            $academic_informations = null;
            $assessment_board_learning_difficulties = null;
            $learning_difficulties = null;
            $selected_course=null;
            $mediation_needed=null;
            $mediations_mediator=null;
        }



        return $this->render('student/show.html.twig', array(
            'student' => $student,
            'pending_student_meetings' => $pending_student_meetings,
            'student_meetings' => $student_meetings,
            'student_warnings' => $student_warnings,
            'delete_form' => $deleteForm->createView(),
            'academic_informations' => $academic_informations,
            'assessment_board_learning_difficulties' => $assessment_board_learning_difficulties,
            'learning_difficulties' => $learning_difficulties,
            'selected_course'=>$selected_course,
            'mediation_needed'=>$mediation_needed,
            'mediations_mediator'=>$mediations_mediator,
            'status_real_course'=>$status_real_course
        ));
    }

    /**
     * Displays a form to edit an existing student entity.
     *
     */
    public function editAction(Request $request, Student $student)
    {
        $deleteForm = $this->createDeleteForm($student);

        $student->setBirthDate($student->getBirthDate()->format('Y-m-d'));
        $editForm = $this->createForm('AppBundle\Form\StudentType', $student);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $student->setBirthDate(new \DateTime($student->getBirthDate()));
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
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_JEFATURA')")
     */
    public function courseAction($student_id)
    {
        $em = $this->getDoctrine()->getManager();

        $student = $em->getRepository('AppBundle:Student')->find($student_id);
        if ($student->getCourseType()) {
            $courses = $em->getRepository('AppBundle:Course')->findCoursesStatusUnity(1, $student->getCourseType()->getId());//encuentra cursos activos del tipo que le corresponde
        } else {
            $courses = $em->getRepository('AppBundle:Course')->findAll();
        }
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
        $student->setCourseType($course->getCourseType());
        $em->persist($student);
        $em->flush();

        $securityContext = $this->get('security.authorization_checker');
        if ($securityContext->isGranted('ROLE_TEACHER')) {
            return $this->redirectToRoute('course_show', array('id' => $this->getUser()->getTeacher()->getMentorCourse()->getId()));
        }

        return $this->redirectToRoute('student_show', array('id' => $student->getId()));


    }
}
