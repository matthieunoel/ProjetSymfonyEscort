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
	use Doctrine\ORM\Mapping\Id;
	use Symfony\Component\Form\Extension\Core\Type\ButtonType;
	use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\Extension\Core\Type\TelType;
    use Symfony\Component\Form\Extension\Core\Type\DateType;
    use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class BambinController extends Controller
{
    
    /**
     * @Route("/montrer-bambins")
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
     * @Route("/modif-bambin/{id}")   
     */
    public function updateAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $bambin = $em->getRepository('CharlesBundle:Bambin')->find($id);

        // if (!$bambin) {
        //     throw $this->createNotFoundException(
        //         'Il n\'y a pas de bambin ayant l\'id ' . $id
        //     );
        // }

        if (!$bambin) {
            $Erreur = 'Il n\'y a pas de bambin ayant l\'id ' . $id;
            return $this->render(
                'bambin/view.html.twig',
                array('Erreur' => $Erreur)
            );
        }

        $form = $this->createFormBuilder($bambin)
            ->add('bambinNom', TextType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('bambinPrenom', TextType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('bambinSexe', ChoiceType::class, [
                'choices'  => [
                    'Un Garçon' => 1,
                    'Une Fille' => 2,
                    'Gamin' => 3,
                    'Un Kikou LOL joueur de Fortnite' => 4,
                    'Un Baveux' => 5,
                    'Un Accident' => 6,
                    'Un Atutre' => 0,
                ],
                'attr' => [
                    'class' => 'ChoiceArea'
                ],
            ])
			->add('bambinDateNaiss', DateType::class, ['attr' => [
                'class' => 'DateArea'
            ],
                'widget' => 'choice',
                'years' => range(date('Y') - 100, date('Y')),
                'months' => range(1, 12),
                'days' => range(1, 31)
            ])
            ->add('bambinDetails', TextareaType::class, ['attr' => ['class' => 'TextBoxArea'],])
            ->add('save', SubmitType::class, ['label' => 'Mettre a jour', 'attr' => ['class' => 'Button']])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $bambin = $form->getData();
            $em->flush();

            return $this->redirect('/voir-bambin/' . $id);
        }

        return $this->render(
            'bambin/edit.html.twig',
            array('form' => $form->createView(), 'id' => $id)
        );
    }

    /**
     * @Route("/creer-bambin/{id}")
     */
    public function createAction(Request $request, $id)
    {
        $bambin = new bambin();
        $form = $this->createFormBuilder($bambin)
            ->add('bambinNom', TextType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('bambinPrenom', TextType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('client_id', TextType::class, ['attr' => ['class' => 'TextArea'],]) 
            ->add('bambinSexe', ChoiceType::class, [
                'choices'  => [
                    'Un Garçon' => 1,
                    'Une Fille' => 2,
                    'Gamin' => 3,
                    'Un Kikou LOL joueur de Fortnite' => 4,
                    'Un Baveux' => 5,
                    'Un Accident' => 6,
                    'Un Autre' => 0,
                ],
                'attr' => [
                    'class' => 'ChoiceArea'
                ],
            ])
            ->add('bambinDateNaiss', DateType::class, ['attr' => [
                'class' => 'DateArea'
            ],
                'widget' => 'choice',
                'years' => range(date('Y') - 100, date('Y')),
                'months' => range(1, 12),
                'days' => range(1, 31)
            ])
            ->add('bambinDetails', TextareaType::class, ['attr' => ['class' => 'TextBoxArea'],])
            ->add('save', SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'Button']])
            ->getForm(); 

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $bambin = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($bambin);
            $em->flush();

            return $this->redirect('/voir-bambin/'  . $bambin->getId());  //. $bambin->getClientId() . '/' à ajouter quand client_id ne sera plus nul
        }

        return $this->render(
            'bambin/edit.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/voir-bambin/{id}")
     */
    public function viewAction($id)
    {

        $bambin = $this->getDoctrine()
            ->getRepository('CharlesBundle:Bambin')
            ->find($id);

        // if (!$bambin) {
        //     throw $this->createNotFoundException(
        //         'Il n\'y a pas de bambin ayant l\'id ' . $id
        //     );
        // }

        if (!$bambin) {
            $Erreur = 'Il n\'y a pas de bambin ayant l\'id ' . $id;
            return $this->render(
                'bambin/view.html.twig',
                array('Erreur' => $Erreur)
            );
        }

        // On met la valeur de IsLogin sur true entant donne que tout le monde est login tout le temps
        $IsLogin = true; 

        return $this->render(
            'bambin/view.html.twig',
            array('bambin' => $bambin, 'IsLogin' => $IsLogin)
        );
    }

    /**
     * @Route("/suppr-bambin/{id}")
     */
    public function supprAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $bambin = $em->getRepository('CharlesBundle:Bambin')->find($id);

        if (!$bambin) {
            throw $this->createNotFoundException(
                'There are no bambins with the following id: ' . $id
            );
        }

        $em->remove($bambin);
        $em->flush();

        return $this->redirect('/montrer-bambins' );        // '/' . getClientId() . 
    }

}