<?php
namespace CharlesBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

    use CharlesBundle\Entity\Surveillance;
    // use Doctrine\DBAL\Types\DateType;
    use Doctrine\DBAL\Types\TextType as TypesTextType;
    // use Doctrine\DBAL\Types\TimeType;
    use Doctrine\ORM\Mapping\Id;
    use Symfony\Component\Form\Extension\Core\Type\ButtonType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\Extension\Core\Type\TelType;
    use Symfony\Component\Form\Extension\Core\Type\DateType;
    use Symfony\Component\Form\Extension\Core\Type\TimeType;
    use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class SurveillanceController extends Controller
{
    /**
     * @Route("/validation-srv/{id}")
     */
    public function ValidateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $nounou = $em->getRepository('CharlesBundle:Nounou')->find($id);

        if (!$nounou) {
            $Erreur = 'Il n\'y a pas de surveillance ayant l\'id ' . $id;
            return $this->render(
                'surveillance/accept.html.twig',
                array('Erreur' => $Erreur)
            );
        }

        $surveillances = $this->getDoctrine()
            ->getRepository('CharlesBundle:Surveillance')
            ->findAll();

        return $this->render(
            'Surveillance/accept.html.twig',
            array('nounou' => $nounou, 'surveillances' => $surveillances, 'IdUrl' => $id)
        );
    }
  
    /**
     * @Route("/accepter-srv/{id}")
     */
    public function accAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $surveillance = $em->getRepository('CharlesBundle:Surveillance')->find($id);

        if (!$surveillance) {
            $Erreur = 'Il n\'y a pas de surveillance ayant l\'id ' . $id;
            return $this->render(
                'surveillance/accept.html.twig',
                array('Erreur' => $Erreur)
            );
        }
        // $em-> ($surveillance);
        $surveillance->setSrvValide(true);
        $nounou = $em->getRepository('CharlesBundle:Nounou')->find($surveillance->getNounou());
        $em->flush();

        return $this->redirect("/validation-srv/{$nounou->getId()}");
    }

    /**
     * @Route("/creer-srv/{id}")
     */
    public function createAction(Request $request, $id)
    {
        // Ici, $id est l'id du client a l'origine de la creation
        $surveillance = new surveillance();
        $form = $this->createFormBuilder($surveillance)
            ->add('srvDate', DateType::class, [
                'attr' => [
                    'class' => 'DateArea'
                ],
                'widget' => 'choice',
                'years' => range(date('Y'), date('Y') + 5),
                'months' => range(1, 12),
                'days' => range(1, 31)
            ])
            ->add('srvDuree', TimeType::class, [
                'attr' => [
                    'class' => 'DateArea'
                ],
                // 'widget' => 'choice',
                // 'years' => range(date('Y') - 100, date('Y')),
                // 'months' => range(1, 12),
                // 'days' => range(1, 31)
            ])
            ->add('srvLieu', TextType::class, ['attr' => ['class' => 'TextArea'],])
            ->add('nounou', TextType::class, ['attr' => ['class' => 'TextArea'],])
            // ->add('client', textType::class, ['attr' => ['class' => 'TextArea', 'style' => 'visibility: hidden;', 'value' => $id],])
            ->add('save', SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'Button']])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();
            $client = $em->getRepository('CharlesBundle:Client')->find($id);
            $nounou = $em->getRepository('CharlesBundle:Nounou')->find(1);

            $surveillance = $form->getData();
            $surveillance->setClient($client);
            $surveillance->setNounou($nounou);
            $surveillance->setSrvValide(0);

            $em->persist($surveillance);
            $em->flush();

            return $this->redirect('/voir-client/' . $id);
        }

        return $this->render(
            'surveillance/create.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/suppr-srv/{id}")
     */
    public function supprAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $surveillance = $em->getRepository('CharlesBundle:Surveillance')->find($id);
        if (!$surveillance) {
            throw $this->createNotFoundException(
                'Il n\'y a pas de surveillance avec l\'id: ' . $id
            );
        }
        $em->remove($surveillance);
        $em->flush();
        return $this->redirect('/validation-srv/1');
    }
}