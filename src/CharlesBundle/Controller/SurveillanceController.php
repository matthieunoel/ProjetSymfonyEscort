<?php
namespace CharlesBundle\Controller;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
     * @Route("/validation-srv/{id}")
     */
    public function ValidateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $nounou = $em->getRepository('CharlesBundle:Nounou')->find($id);

        if (!$nounou) {
            $Erreur = 'Il n\'y a pas de nounou ayant l\'id ' . $id;
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
    public function supprAction($id)
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
}