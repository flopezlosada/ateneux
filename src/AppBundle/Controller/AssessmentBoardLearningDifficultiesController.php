<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AssessmentBoard;
use AppBundle\Entity\AssessmentBoardLearningDifficulties;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Assessmentboardlearningdifficulties controller.
 *
 */
class AssessmentBoardLearningDifficultiesController extends Controller
{
    /**
     * Lists all assessmentBoardLearningDifficulties entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $assessmentBoardLearningDifficulties = $em->getRepository('AppBundle:AssessmentBoardLearningDifficulties')->findAll();

        return $this->render('assessmentboardlearningdifficulties/index.html.twig', array(
            'assessmentBoardLearningDifficulties' => $assessmentBoardLearningDifficulties,
        ));
    }


    /**
     * Creates a new assessmentBoardLearningDifficulty entity.
     *
     */
    public function newAction(Request $request)
    {
        $assessmentBoardLearningDifficulty = new Assessmentboardlearningdifficulty();
        $form = $this->createForm('AppBundle\Form\AssessmentBoardLearningDifficultiesType', $assessmentBoardLearningDifficulty);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($assessmentBoardLearningDifficulty);
            $em->flush();

            return $this->redirectToRoute('assessmentboardlearningdifficulties_show', array('id' => $assessmentBoardLearningDifficulty->getId()));
        }

        return $this->render('assessmentboardlearningdifficulties/new.html.twig', array(
            'assessmentBoardLearningDifficulty' => $assessmentBoardLearningDifficulty,
            'form' => $form->createView(),
        ));
    }

    public function new_groupAction(Request $request, AssessmentBoard $assessmentBoard)
    {
        $students = $assessmentBoard->getCourse()->getStudents();



        return $this->render('assessmentboardlearningdifficulties/new_group.html.twig', array(
            'assessmentBoard' => $assessmentBoard,
            'students'=>$students
        ));
    }


    public function createAction(Request $request, AssessmentBoard  $assessmentBoard)
    {
       $students=$request->get('student');
        $students_difficulties=$request->Get('difficulties');
        $em=$this->getDoctrine()->getManager();
        foreach ($students as $student_key=>$student_value)
        {
            $difficult=new AssessmentBoardLearningDifficulties();
            $student=$em->getRepository("AppBundle:Student")->find($student_key);
            $difficult->setStudent($student);
            $difficult->setAssessmentBoard($assessmentBoard);
            $difficult->setCourse($assessmentBoard->getCourse());
            $difficult->setLearningDifficulties($students_difficulties[$student_key]);
            $em->persist($difficult);
        }

        $em->flush();

        return $this->redirectToRoute('assessmentboard_show', array('id' => $assessmentBoard->getId()));
    }
    /**
     * Finds and displays a assessmentBoardLearningDifficulties entity.
     *
     */
    public function showAction(AssessmentBoardLearningDifficulties $assessmentBoardLearningDifficulties)
    {
        $deleteForm = $this->createDeleteForm($assessmentBoardLearningDifficulties);

        return $this->render('assessmentboardlearningdifficulties/show.html.twig', array(
            'assessmentBoardLearningDifficulties' => $assessmentBoardLearningDifficulties,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing assessmentBoardLearningDifficulties entity.
     *
     */
    public function editAction(Request $request, AssessmentBoardLearningDifficulties $assessmentBoardLearningDifficulties)
    {
        $deleteForm = $this->createDeleteForm($assessmentBoardLearningDifficulties);
        $editForm = $this->createForm('AppBundle\Form\AssessmentBoardLearningDifficultiesType', $assessmentBoardLearningDifficulties);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('assessmentboard_show', array('id' => $assessmentBoardLearningDifficulties->getAssessmentBoard()->getId()));
        }

        return $this->render('assessmentboardlearningdifficulties/edit.html.twig', array(
            'assessmentBoardLearningDifficulties' => $assessmentBoardLearningDifficulties,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a assessmentBoardLearningDifficulties entity.
     *
     */
    public function deleteAction(Request $request, AssessmentBoardLearningDifficulties $assessmentBoardLearningDifficulties)
    {
        $form = $this->createDeleteForm($assessmentBoardLearningDifficulties);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($assessmentBoardLearningDifficulties);
            $em->flush();
        }

        return $this->redirectToRoute('assessmentboardlearningdifficulties_index');
    }

    /**
     * Creates a form to delete a assessmentBoardLearningDifficulties entity.
     *
     * @param AssessmentBoardLearningDifficulties $assessmentBoardLearningDifficulties The assessmentBoardLearningDifficulties entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AssessmentBoardLearningDifficulties $assessmentBoardLearningDifficulties)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('assessmentboardlearningdifficulties_delete', array('id' => $assessmentBoardLearningDifficulties->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    }
