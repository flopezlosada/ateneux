<?php

namespace AppBundle\Controller;

use AppBundle\Entity\StudentSchool;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * Studentschool controller.
 *
 */
class StudentSchoolController extends Controller
{
    /**
     * Lists all studentSchool entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $studentSchools = $em->getRepository('AppBundle:StudentSchool')->findAll();

        return $this->render('studentschool/index.html.twig', array(
            'studentSchools' => $studentSchools,
        ));
    }

    /**
     * Creates a new studentSchool entity.
     *
     */
    public function newAction($student_id,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $student = $em->getRepository('AppBundle:Student')->find($student_id);
        if ($this->get('security.authorization_checker')->isGranted("ROLE_ADMIN")
            or ($this->get('security.authorization_checker')->isGranted("ROLE_TEACHER")
                and $this->getUser()->getTeacher()->getMentorCourse()->getId() == $student->getCourse()->getId())) {
            $studentSchool = new Studentschool();

            $form = $this->createForm('AppBundle\Form\StudentSchoolType', $studentSchool);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $studentSchool->setStudent($student);
                $student->setStudentSchool($studentSchool);

                $em->persist($student);
                $em->persist($studentSchool);
                $em->flush();

                return $this->redirectToRoute('student_show', array('id' => $studentSchool->getStudent()->getId()));
            }

            return $this->render('studentschool/new.html.twig', array(
                'studentSchool' => $studentSchool,
                'form' => $form->createView(),
            ));
        }
    }

    /**
     * Finds and displays a studentSchool entity.
     *
     */
    public function showAction(StudentSchool $studentSchool)
    {
        $deleteForm = $this->createDeleteForm($studentSchool);

        return $this->render('studentschool/show.html.twig', array(
            'studentSchool' => $studentSchool,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing studentSchool entity.
     *
     */
    public function editAction(Request $request, StudentSchool $studentSchool)
    {
        $deleteForm = $this->createDeleteForm($studentSchool);
        $editForm = $this->createForm('AppBundle\Form\StudentSchoolType', $studentSchool);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('student_show', array('id' => $studentSchool->getStudent()->getId()));
        }

        return $this->render('studentschool/edit.html.twig', array(
            'studentSchool' => $studentSchool,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a studentSchool entity.
     *
     */
    public function deleteAction(Request $request, StudentSchool $studentSchool)
    {
        $form = $this->createDeleteForm($studentSchool);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($studentSchool);
            $em->flush();
        }

        return $this->redirectToRoute('studentschool_index');
    }

    /**
     * Creates a form to delete a studentSchool entity.
     *
     * @param StudentSchool $studentSchool The studentSchool entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(StudentSchool $studentSchool)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('studentschool_delete', array('id' => $studentSchool->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
