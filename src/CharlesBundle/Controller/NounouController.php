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
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\Extension\Core\Type\TelType;
    use Symfony\Component\Form\Extension\Core\Type\DateType;
    use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class NounouController extends Controller
{
    
    /**
     * @Route("/montrer-nounous")
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
     * @Route("/modif-nounou/{id}")
     */
    public function updateAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $nounou = $em->getRepository('CharlesBundle:Nounou')->find($id);

        // if (!$nounou) {
        //     throw $this->createNotFoundException(
        //         'Il n\'y a pas de nounou ayant l\'id ' . $id
        //     );
        // }

        if (!$nounou) {
            $Erreur = 'Il n\'y a pas de nounou ayant l\'id ' . $id;
            return $this->render(
                'nounou/view.html.twig',
                array('Erreur' => $Erreur)
            );
        }

        $form = $this->createFormBuilder($nounou)
            ->add('nounouNom', TextType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('nounouPrenom', TextType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('nounouSexe', ChoiceType::class, [
                'choices'  => [
                    'Homme' => 1,
                    'Femme' => 2,
                    'Hélicoptère 2 Kombat' => 3,
                    'Asexuée' => 4,
                    'Intersexuée' => 5,
                    'Code wifi' => 6,
                    'Raptor' => 7,
                    'Ne prefere pas en parler' => 8,
                    'Cailloux' => 9,
                    'Autre' => 0,
                ],
                'attr' => [
                    'class' => 'ChoiceArea'
                ],
            ])
            ->add('nounouMdp', PasswordType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('nounouMail', EmailType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('nounouDateNaiss', DateType::class, ['attr' => ['class' => 'DateArea'],])
            ->add('nounouTarif', TextType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('nounouDesc', TextareaType::class, ['attr' => ['class' => 'TextBoxArea'],])
            ->add('nounouAdresse', TextType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('nounouTelPro', TelType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('nounouTelPerso', TelType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('nounouPhoto', TextType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('save', SubmitType::class, ['label' => 'Mettre a jour', 'attr' => ['class' => 'Button']])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $nounou = $form->getData();
            $em->flush();

            return $this->redirect('/voir-nounou/' . $id);
        }

        return $this->render(
            'nounou/edit.html.twig',
            array('form' => $form->createView(), 'id' => $id)
        );
    }

    /**
     * @Route("/creer-nounou")
     */
    public function createAction(Request $request)
    {

        $nounou = new nounou();
        $form = $this->createFormBuilder($nounou)
            ->add('nounouMdp', PasswordType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('nounouNom', TextType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('nounouPrenom', TextType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('nounouSexe', ChoiceType::class, [
                'choices'  => [
                    'Homme' => 1,
                    'Femme' => 2,
                    'Hélicoptère 2 Kombat' => 3,
                    'Asexué' => 4,
                    'Intersexué' => 5,
                    'Code wifi' => 6,
                    'Raptor' => 7,
                    'Ne prefere pas en parler' => 8,
                    'Cailloux' => 9,
                    'Autre' => 0,
                ],
                'attr' => [
                    'class' => 'ChoiceArea'
                ],
            ])
            ->add('nounouMail', EmailType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('nounouDateNaiss', DateType::class, ['attr' => ['class' => 'DateArea'],])
            ->add('nounouTarif', TextType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('nounouDesc', TextareaType::class, ['attr' => ['class' => 'TextBoxArea'],])
            ->add('nounouAdresse', TextType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('nounouTelPro', TelType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('nounouTelPerso', TelType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('nounouPhoto', TextType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('save', SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'Button']])
            ->getForm(); 

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $nounou = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($nounou);
            $em->flush();

            return $this->redirect('/voir-nounou/' . $nounou->getId());
        }

        return $this->render(
            'nounou/edit.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/voir-nounou/{id}")
     */
    public function viewAction($id)
    {

        $nounou = $this->getDoctrine()
            ->getRepository('CharlesBundle:Nounou')
            ->find($id);

        // if (!$nounou) {
        //     throw $this->createNotFoundException(
        //         'Il n\'y a pas de nounou ayant l\'id ' . $id
        //     );
        // }

        if (!$nounou) {
            $Erreur = 'Il n\'y a pas de nounou ayant l\'id ' . $id;
            return $this->render(
                'nounou/view.html.twig',
                array('Erreur' => $Erreur)
            );
        }

        // On met la valeur de IsLogin sur true entant donné que tout le monde est login tout le temps
        $IsLogin = true; 

        return $this->render(
            'nounou/view.html.twig',
            array('nounou' => $nounou, 'IsLogin' => $IsLogin)
        );
    }

    /**
     * @Route("/suppr-nounou/{id}")
     */
    public function supprAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $nounou = $em->getRepository('CharlesBundle:Nounou')->find($id);

        if (!$nounou) {
            throw $this->createNotFoundException(
                'There are no nounous with the following id: ' . $id
            );
        }

        $em->remove($nounou);
        $em->flush();

        return $this->redirect('/montrer-nounous');
    }

}