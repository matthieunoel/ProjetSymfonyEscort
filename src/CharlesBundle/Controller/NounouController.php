<?php

namespace CharlesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use CharlesBundle\Entity\Nounou;

class NounouController extends Controller
{
    
    /**
     * @Route("/show-nounous")
     */

    public function showAction()
    {

        $nounous = $this->getDoctrine()
            ->getRepository('CharlesBundle:Nounou')
            ->findAll();

        return $this->render(
            'Nounou/show.html.twig',
            array('nounous' => $nounous)
        );
    }
}