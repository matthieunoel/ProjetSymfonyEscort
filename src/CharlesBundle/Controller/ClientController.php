<?php

namespace CharlesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use CharlesBundle\Entity\Client;
// use Doctrine\DBAL\Types\DateType;
use Doctrine\DBAL\Types\TextType as TypesTextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ClientController extends Controller
{
    
    /**
     * @Route("/show-clients")
     */

    public function showAction()
    {

        $clients = $this->getDoctrine()
            ->getRepository('CharlesBundle:Client')
            ->findAll();

        return $this->render(
            'Client/show.html.twig',
            array('clients' => $clients)
        );
    }

    /**
     * @Route("/modif-client")
     */

    public function modifAction()
    {

        $clients = $this->getDoctrine()
            ->getRepository('CharlesBundle:Client')
            ->findAll();

        return $this->render(
            'Client/show.html.twig',
            array('clients' => $clients)
        );
    }

    /**
     * @Route("/update-client/{id}")
     */
    public function updateAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository('CharlesBundle:Client')->find($id);

        if (!$client) {
            throw $this->createNotFoundException(
                'There is no client with the following id: ' . $id
            );
        }

        $form = $this->createFormBuilder($client)
            ->add('clientNom', TextType::class)
            ->add('clientPrenom', TextType::class)
            ->add('clientSexe', ChoiceType::class, [
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
            ->add('clientMail', EmailType::class)
            ->add('clientCompteVerif', BoolType::class)
            ->add('clientTel', TelType::class)
            ->add('save', SubmitType::class, array('label' => 'Update'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $client = $form->getData();
            $em->flush();

            return $this->redirect('/view-client/' . $id);
        }

        return $this->render(
            'client/edit.html.twig',
            array('form' => $form->createView())
        );
    }
}