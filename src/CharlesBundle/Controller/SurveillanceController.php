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
    use Doctrine\ORM\Mapping\Id;
    use Symfony\Component\Form\Extension\Core\Type\ButtonType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\Extension\Core\Type\TelType;
    use Symfony\Component\Form\Extension\Core\Type\DateType;
    use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class SurveillanceController extends Controller
{

    /**
     * @Route("/valider-srv/{id}")
     */
    public function ValidateAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $nounou = $em->getRepository('CharlesBundle:Nounou')->find($id);

        if (!$nounou) {
            $Erreur = 'Il n\'y a pas de nounou ayant l\'id ' . $id;
            return $this->render(
                'nounou/view.html.twig',
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

        return $this->redirect('/valider-srv' + $);
    }
}