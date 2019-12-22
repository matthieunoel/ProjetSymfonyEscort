<?php

namespace CharlesBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

    // use Doctrine\DBAL\Types\DateType;
    use Doctrine\DBAL\Types\TextType as TypesTextType;
	use Doctrine\ORM\Mapping\Id;
	use Symfony\Component\Form\Extension\Core\Type\ButtonType;
	use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\Extension\Core\Type\TelType;
    use Symfony\Component\Form\Extension\Core\Type\DateType;
    use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class PageaccueilclientController extends Controller
{
    /**
     * @Route("/accueil-client")
     */

    public function indexAction()
    {
		return $this->render("Pageaccueilclient/index.html.twig");
	}
}
