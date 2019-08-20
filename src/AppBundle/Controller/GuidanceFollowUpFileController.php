<?php

namespace AppBundle\Controller;

use AppBundle\Entity\GuidanceFollowUpFile;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Guidancefollowupfile controller.
 *
 */
class GuidanceFollowUpFileController extends Controller
{
    /**
     * Lists all guidanceFollowUpFile entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $guidanceFollowUpFiles = $em->getRepository('AppBundle:GuidanceFollowUpFile')->findAll();

        return $this->render('guidancefollowupfile/index.html.twig', array(
            'guidanceFollowUpFiles' => $guidanceFollowUpFiles,
        ));
    }

    /**
     * Creates a new guidanceFollowUpFile entity.
     *
     */
    public function newAction(Request $request, $guidance_follow_up_id)
    {


        $guidanceFollowUpFile = new Guidancefollowupfile();
        $em = $this->getDoctrine()->getManager();
        if ($guidance_follow_up_id) {
            $guidance = $em->getRepository("AppBundle:GuidanceFollowUp")->find($guidance_follow_up_id);
            $guidanceFollowUpFile->setGuidanceFollowUp($guidance);
        }
        $form = $this->createForm('AppBundle\Form\GuidanceFollowUpFileType', $guidanceFollowUpFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($guidanceFollowUpFile);
            $em->flush();

            return $this->redirectToRoute('student_show', array('id' => $guidance->getStudent()->getId()));
        }

        return $this->render('guidancefollowupfile/new.html.twig', array(
            'guidanceFollowUpFile' => $guidanceFollowUpFile,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a guidanceFollowUpFile entity.
     *
     */
    public function showAction(GuidanceFollowUpFile $guidanceFollowUpFile)
    {
        $deleteForm = $this->createDeleteForm($guidanceFollowUpFile);

        return $this->render('guidancefollowupfile/show.html.twig', array(
            'guidanceFollowUpFile' => $guidanceFollowUpFile,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing guidanceFollowUpFile entity.
     *
     */
    public function editAction(Request $request, GuidanceFollowUpFile $guidanceFollowUpFile)
    {
        $deleteForm = $this->createDeleteForm($guidanceFollowUpFile);
        $editForm = $this->createForm('AppBundle\Form\GuidanceFollowUpFileType', $guidanceFollowUpFile);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('guidancefollowupfile_edit', array('id' => $guidanceFollowUpFile->getId()));
        }

        return $this->render('guidancefollowupfile/edit.html.twig', array(
            'guidanceFollowUpFile' => $guidanceFollowUpFile,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a guidanceFollowUpFile entity.
     *
     */
    public function deleteAction(Request $request, GuidanceFollowUpFile $guidanceFollowUpFile)
    {
        $form = $this->createDeleteForm($guidanceFollowUpFile);
        $form->handleRequest($request);
        $student = $guidanceFollowUpFile->getGuidanceFollowUp()->getStudent();

        $em = $this->getDoctrine()->getManager();
        $em->remove($guidanceFollowUpFile);
        $em->flush();


        return $this->redirectToRoute('student_show', array("id" => $student->getId()));
    }

    /**
     * Creates a form to delete a guidanceFollowUpFile entity.
     *
     * @param GuidanceFollowUpFile $guidanceFollowUpFile The guidanceFollowUpFile entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(GuidanceFollowUpFile $guidanceFollowUpFile)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('guidancefollowupfile_delete', array('id' => $guidanceFollowUpFile->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
