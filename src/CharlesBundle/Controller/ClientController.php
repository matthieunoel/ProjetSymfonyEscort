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

use Doctrine\ORM\Mapping\Id;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

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

    public function updateAction()
    {

        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository('CharlesBundle:Client')->find($id);
        
        if (!$client) {
            $Erreur = 'Il n\'y a pas de client ayant l\'id ' . $id;
            return $this->render(
                'client/view.html.twig',
                array('Erreur' => $Erreur)
            );
        }
   

        $form = $this->createFormBuilder($client)
            ->add('clientNom', TextType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('clientPrenom', TextType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('clientSexe', ChoiceType::class, [
                'choices'  => [
                    'Homme' => 1,
                    'Femme' => 2,
                    'Licorne' => 3,
                    'Moi' => 4,
                    'Personne' => 5,
                    'Framework' => 6,
                    'Sexe inexistant dans cet univers tridimensionnel' => 7,
                    'Non Binaire' => 8,
                    'Autre' => 0,
                ],
                'attr' => [
                    'class' => 'ChoiceArea' 
                ],
            ])
            ->add('clientMail', EmailType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('clientCompteVerif',CheckboxType::class)
            ->add('clientTel', TelType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('save', SubmitType::class, ['label' => 'Mettre a jour', 'attr' => ['class' => 'Button']])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $client = $form->getData();
            $em->flush();

            return $this->redirect('/view-client/' . $id);
        }

        return $this->render(
            'client/edit.html.twig',
            array('form' => $form->createView(),'id' => $id)
        );
    }

    /**
     * @Route("/creer-client")
     */
    public function createAction(Request $request)
    {
        $client = new client();
        $form = $this->createFormBuilder($client)
            ->add('clientNom', TextType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('clientPrenom', TextType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('clientMdp', PasswordType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('clientSexe', ChoiceType::class, [
                'choices'  => [
                    'Homme' => 1,
                    'Femme' => 2,
                    'Licorne' => 3,
                    'Moi' => 4,
                    'Personne' => 5,
                    'Framework' => 6,
                    'Sexe inexistant dans cet univers tridimensionnel' => 7,
                    'Non Binaire' => 8,
                    'Autre' => 0,
                ],
                'attr' => [
                    'class' => 'ChoiceArea'
                ],
            ])
            ->add('clientCompteVerif',CheckboxType::class)
            ->add('clientMail', EmailType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('clientTel', TelType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('save', SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'Button']])
            ->getForm(); 

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $client = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();

            return $this->redirect('/voir-client/' . $client->getId());
        }

        return $this->render(
            'client/edit.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/voir-client/{id}")
     */
    public function viewAction($id)
    {
        $client = $this->getDoctrine()
        ->getRepository('CharlesBundle:Client')
        ->find($id);

        if (!$client) {
            $Erreur = 'Il n\'y a pas de client ayant l\'id ' . $id;
            return $this->render(
                'client/view.html.twig',
                array('Erreur' => $Erreur)
            );
        }

        // On met la valeur de IsLogin sur true entant donné que tout le monde est login tout le temps
        $IsLogin = true; 

        
        return $this->render(
            'client/view.html.twig',
             array('client' => $client, 'IsLogin' => $IsLogin)
        );

    }

    /**
     * @Route("/suppr-client/{id}")
     */
    public function supprAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository('CharlesBundle:client')->find($id);

        if (!$client) {
            throw $this->createNotFoundException(
                'There are no clients with the following id: ' . $id
            );
        }

        $em->remove($client);
        $em->flush();

        return $this->redirect('/montrer-clients');
    }

    /**
     * @Route("/login-client")
     */
    public function loginAction()
    {
        return $this->redirect('/menu-client');
    }
    /**
     * @Route("/menu-client")
     */
    public function menuAction()
    {
        return $this->render('client/menu.html.twig');
    }

}