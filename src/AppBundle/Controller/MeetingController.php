<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Meeting;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Meeting controller.
 *
 */
class MeetingController extends Controller
{
    /**
     * Lists all meeting entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $meetings = $em->getRepository('AppBundle:Meeting')->findAll();


        return $this->render('meeting/index.html.twig', array(
            'meetings' => $meetings,
        ));
    }

    /**
     * Creates a new meeting entity.
     *
     */
    public function newAction($student_id, Request $request)
    {
        $meeting = new Meeting();
        $em = $this->getDoctrine()->getManager();
        $student = $em->getRepository('AppBundle:Student')->find($student_id);

        $meeting_status = $em->getRepository('AppBundle:MeetingStatus')->find(1);


        $form = $this->createForm('AppBundle\Form\MeetingType', $meeting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $meeting->setStudentMeeting($student);
            $meeting->setCourse($student->getCourse());
            $meeting->setMeetingStatus($meeting_status);
            //$student->addMeeting($meeting);

            $em->persist($meeting);
            $meeting->setDate(new \DateTime($meeting->getDate()));
            $em->persist($meeting);
            $em->flush();

            return $this->redirectToRoute('student_show', array('id' => $student->getId()));
        }

        return $this->render('meeting/new.html.twig', array(
            'meeting' => $meeting,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a meeting entity.
     *
     */
    public function showAction(Meeting $meeting)
    {
        $deleteForm = $this->createDeleteForm($meeting);

        return $this->render('meeting/show.html.twig', array(
            'meeting' => $meeting,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing meeting entity.
     *
     */
    public function editAction(Request $request, Meeting $meeting)
    {
        $deleteForm = $this->createDeleteForm($meeting);
        $meeting->setDate($meeting->getDate()->format('Y-m-d'));
        $editForm = $this->createForm('AppBundle\Form\MeetingEditType', $meeting);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $meeting->setDate(new \DateTime($meeting->getDate()));
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('meeting_show', array('id' => $meeting->getId()));
        }

        return $this->render('meeting/edit.html.twig', array(
            'meeting' => $meeting,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a meeting entity.
     *
     */
    public function deleteAction(Request $request, Meeting $meeting)
    {
        $form = $this->createDeleteForm($meeting);
        $form->handleRequest($request);
        $student = $meeting->getStudentMeeting();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($meeting);
            $em->flush();
        }

        return $this->redirectToRoute('student_show', array('id'=>$student->getId()));
    }

    /**
     * Creates a form to delete a meeting entity.
     *
     * @param Meeting $meeting The meeting entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Meeting $meeting)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('meeting_delete', array('id' => $meeting->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    public function changeStatusAction(Meeting $meeting, $meeting_status_id)
    {
        $em = $this->getDoctrine()->getManager();
        $meeting_status = $em->getRepository("AppBundle:MeetingStatus")->find($meeting_status_id);
        $meeting->setMeetingStatus($meeting_status);
        $em->persist($meeting);
        $em->flush();

        return $this->redirectToRoute('meeting_show', array('id' => $meeting->getId()));
    }
}
