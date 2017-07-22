<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {


        return $this->redirect($this->generateUrl('dashboard'));
    }


    /**
     * @Route("/gestion/dashboard", name="dashboard")
     * @Template()
     */
    public function dashboardAction()
    {
        if ($this->get('security.authorization_checker')->isGranted("ROLE_TEACHER"))
        {
            return $this->redirect($this->generateUrl('teacher_show', array('id' => $this->getUser()->getTeacher()->getId())));
        }

    }
}
