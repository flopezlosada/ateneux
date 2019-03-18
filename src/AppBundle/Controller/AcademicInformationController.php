<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AcademicInformation;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Academicinformation controller.
 *
 */
class AcademicInformationController extends Controller
{
    /**
     * Lists all academicInformation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $academicInformations = $em->getRepository('AppBundle:AcademicInformation')->findAll();

        return $this->render('academicinformation/index.html.twig', array(
            'academicInformations' => $academicInformations,
        ));
    }

    /**
     * Creates a new academicInformation entity.
     *
     */
    public function newAction($meeting_id, Request $request)
    {
        $academicInformation = new Academicinformation();
        $em = $this->getDoctrine()->getManager();
        $meeting = $em->getRepository("AppBundle:Meeting")->find($meeting_id);
        $form = $this->createForm('AppBundle\Form\AcademicInformationType', $academicInformation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {

            $academicInformation->setMeeting($meeting);
            $academicInformation->setDate(new \DateTime($academicInformation->getDate()));
            $academicInformation->setStudent($meeting->getStudentMeeting());

            $em->persist($meeting);
            $em->persist($academicInformation);
            $em->flush();

            return $this->redirectToRoute('meeting_show', array('id' => $academicInformation->getMeeting()->getId()));
        }

        return $this->render('academicinformation/new.html.twig', array(
            'academicInformation' => $academicInformation,
            'form' => $form->createView(),
            'student' => $meeting->getStudentMeeting(),
            'meeting' => $meeting
        ));
    }

    /**
     * Finds and displays a academicInformation entity.
     *
     */
    public function showAction(AcademicInformation $academicInformation)
    {
        $deleteForm = $this->createDeleteForm($academicInformation);

        return $this->render('academicinformation/show.html.twig', array(
            'academicInformation' => $academicInformation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing academicInformation entity.
     *
     */
    public function editAction(Request $request, AcademicInformation $academicInformation)
    {
        $deleteForm = $this->createDeleteForm($academicInformation);
        $academicInformation->setDate($academicInformation->getDate()->format('Y-m-d'));
        $editForm = $this->createForm('AppBundle\Form\AcademicInformationType', $academicInformation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $academicInformation->setDate(new \DateTime($academicInformation->getDate()));
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('student_show', array('id' => $academicInformation->getStudent()->getId()));
        }

        return $this->render('academicinformation/edit.html.twig', array(
            'academicInformation' => $academicInformation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'student' => $academicInformation->getStudent(),

        ));
    }

    /**
     * Deletes a academicInformation entity.
     *
     */
    public function deleteAction(Request $request, AcademicInformation $academicInformation)
    {
        $form = $this->createDeleteForm($academicInformation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($academicInformation);
            $em->flush();
        }

        return $this->redirectToRoute('academicinformation_index');
    }

    /**
     * Creates a form to delete a academicInformation entity.
     *
     * @param AcademicInformation $academicInformation The academicInformation entity
     *
     * @return \Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(AcademicInformation $academicInformation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('academicinformation_delete', array('id' => $academicInformation->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    public function associateAction($meeting_id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $meeting = $em->getRepository("AppBundle:Meeting")->find($meeting_id);
        $form = $this->createFormBuilder()
            ->add('academic', EntityType::class, array(
                'class' => 'AppBundle\Entity\AcademicInformation',
                'expanded' => true,
                'multiple' => false,
                'query_builder' => function (EntityRepository $repository) use ($meeting)
                {
                    $qb = $repository->createQueryBuilder('a')
                        ->where('a.student = :student')
                        ->orderBy("a.date", "DESC")
                        ->setParameter('student', $meeting->getStudentMeeting()->getId());

                    return $qb;
                },
                'label' => 'Selecciona la información sobre la/el estudiante: ',
            ))
            ->add('send', SubmitType::class, array('label' => 'Aceptar'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {

            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();
            $academic=$data['academic'];

            $meeting->addAcademicInformation($academic);
            $em->persist($meeting);
            $em->flush();

            return $this->redirectToRoute('student_show', array('id' => $meeting->getStudentMeeting()->getId()));
        }

        return $this->render(':academicinformation:associate.html.twig', array(
            'form' => $form->createView(),
            'student' => $meeting->getStudentMeeting(),
            'meeting' => $meeting
        ));

    }
}
