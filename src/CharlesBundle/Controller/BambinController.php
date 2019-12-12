<?php

namespace CharlesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use CharlesBundle\Entity\Bambin;
// use Doctrine\DBAL\Types\DateType;
use Doctrine\DBAL\Types\TextType as TypesTextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class BambinController extends Controller
{
    
    /**
     * @Route("/show-bambins")
     */

    public function showAction()
    {

        $bambins = $this->getDoctrine()
            ->getRepository('CharlesBundle:Bambin')
            ->findAll();

        return $this->render(
            'Bambin/show.html.twig',
            array('bambins' => $bambins)
        );
    }

    /**
     * @Route("/modif-bambin")
     */

    public function modifAction()
    {

        $bambins = $this->getDoctrine()
            ->getRepository('CharlesBundle:Bambin')
            ->findAll();

        return $this->render(
            'Bambin/show.html.twig',
            array('bambins' => $bambins)
        );
    }

    /**
     * @Route("/update-bambin/{id}")
     */
    public function updateAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $bambin = $em->getRepository('CharlesBundle:Bambin')->find($id);

        if (!$bambin) {
            throw $this->createNotFoundException(
                'There is no bambin with the following id: ' . $id
            );
        }

        $form = $this->createFormBuilder($bambin)
            ->add('bambinNom', TextType::class)
            ->add('bambinPrenom', TextType::class)
            ->add('bambinDateNaiss', DateType::class)
            ->add('bambinSexe', ChoiceType::class, [
                'choices'  => [
                    'Homme' => 1,
                    'Femme' => 2,
                    'Helicoptère combat' => 3,
                    'Asexuée' => 4,
                    'Intersexuée' => 5,
                    'Code wifi' => 6,
                    'Raptor' => 7,
                    'Ne prefere pas en parler' => 8,
                    'Cailloux' => 9,
                    'Autre' => 0,
                ]
            ])
            ->add('bambinDetails', EmailType::class)
            ->add('save', SubmitType::class, array('label' => 'Update'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $bambin = $form->getData();
            $em->flush();

            return $this->redirect('/view-bambin/' . $id);
        }

        return $this->render(
            'bambin/edit.html.twig',
            array('form' => $form->createView())
        );
    }
}