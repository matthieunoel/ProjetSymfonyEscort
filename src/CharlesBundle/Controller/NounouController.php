<?php

namespace CharlesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use CharlesBundle\Entity\Nounou;
// use Doctrine\DBAL\Types\DateType;
use Doctrine\DBAL\Types\TextType as TypesTextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

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

    /**
     * @Route("/modif-nounou")
     */

    public function modifAction()
    {

        $nounous = $this->getDoctrine()
            ->getRepository('CharlesBundle:Nounou')
            ->findAll();

        return $this->render(
            'Nounou/show.html.twig',
            array('nounous' => $nounous)
        );
    }

    /**
     * @Route("/update-nounou/{id}")
     */
    public function updateAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $nounou = $em->getRepository('CharlesBundle:Nounou')->find($id);

        if (!$nounou) {
            throw $this->createNotFoundException(
                'There are no nounous with the following id: ' . $id
            );
        }

        $form = $this->createFormBuilder($nounou)
            ->add('nounouNom', TextType::class)
            ->add('nounouPrenom', TextType::class)
            ->add('nounouSexe', ChoiceType::class, [
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
            ->add('nounouMail', EmailType::class)
            ->add('nounouDateNaiss', DateType::class)
            ->add('nounouTarif', TextType::class)
            ->add('nounouDesc', TextareaType::class)
            ->add('nounouAdresse', TextType::class)
            ->add('nounouTelPro', TelType::class)
            ->add('nounouTelPerso', TelType::class)
            ->add('save', SubmitType::class, array('label' => 'Update'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $nounou = $form->getData();
            $em->flush();

            return $this->redirect('/view-nounou/' . $id);
        }

        return $this->render(
            'nounou/edit.html.twig',
            array('form' => $form->createView())
        );
    }
}