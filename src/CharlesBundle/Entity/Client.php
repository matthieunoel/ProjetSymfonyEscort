<?php

namespace CharlesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="CharlesBundle\Repository\ClientRepository")
 */
class Client
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="client_nom", type="string", length=255)
     */
    private $clientNom;

    /**
     * @var string
     *
     * @ORM\Column(name="client_prenom", type="string", length=255)
     */
    private $clientPrenom;

    /**
     * @var int
     *
     * @ORM\Column(name="client_sexe", type="integer")
     */
    private $clientSexe;

    /**
     * @var string
     *
     * @ORM\Column(name="client_mdp", type="string", length=255)
     */
    private $clientMdp;

    /**
     * @var bool
     *
     * @ORM\Column(name="client_compte_verif", type="boolean")
     */
    private $clientCompteVerif;

    /**
     * @var string
     *
     * @ORM\Column(name="client_tel", type="string", length=15)
     */
    private $clientTel;

    /**
     * @var string
     *
     * @ORM\Column(name="client_mail", type="string", length=255, unique=true)
     */
    private $clientMail;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set clientNom
     *
     * @param string $clientNom
     *
     * @return Client
     */
    public function setClientNom($clientNom)
    {
        $this->clientNom = $clientNom;

        return $this;
    }

    /**
     * Get clientNom
     *
     * @return string
     */
    public function getClientNom()
    {
        return $this->clientNom;
    }

    /**
     * Set clientPrenom
     *
     * @param string $clientPrenom
     *
     * @return Client
     */
    public function setClientPrenom($clientPrenom)
    {
        $this->clientPrenom = $clientPrenom;

        return $this;
    }

    /**
     * Get clientPrenom
     *
     * @return string
     */
    public function getClientPrenom()
    {
        return $this->clientPrenom;
    }

    /**
     * Set clientSexe
     *
     * @param integer $clientSexe
     *
     * @return Client
     */
    public function setClientSexe($clientSexe)
    {
        $this->clientSexe = $clientSexe;

        return $this;
    }

    /**
     * Get clientSexe
     *
     * @return int
     */
    public function getClientSexe()
    {
        return $this->clientSexe;
    }

    /**
     * Set clientMdp
     *
     * @param string $clientMdp
     *
     * @return Client
     */
    public function setClientMdp($clientMdp)
    {
        $this->clientMdp = $clientMdp;

        return $this;
    }

    /**
     * Get clientMdp
     *
     * @return string
     */
    public function getClientMdp()
    {
        return $this->clientMdp;
    }

    /**
     * Set clientCompteVerif
     *
     * @param boolean $clientCompteVerif
     *
     * @return Client
     */
    public function setClientCompteVerif($clientCompteVerif)
    {
        $this->clientCompteVerif = $clientCompteVerif;

        return $this;
    }

    /**
     * Get clientCompteVerif
     *
     * @return bool
     */
    public function getClientCompteVerif()
    {
        return $this->clientCompteVerif;
    }

    /**
     * Set clientTel
     *
     * @param string $clientTel
     *
     * @return Client
     */
    public function setClientTel($clientTel)
    {
        $this->clientTel = $clientTel;

        return $this;
    }

    /**
     * Get clientTel
     *
     * @return string
     */
    public function getClientTel()
    {
        return $this->clientTel;
    }

    /**
     * Set clientMail
     *
     * @param string $clientMail
     *
     * @return Client
     */
    public function setClientMail($clientMail)
    {
        $this->clientMail = $clientMail;

        return $this;
    }

    /**
     * Get clientMail
     *
     * @return string
     */
    public function getClientMail()
    {
        return $this->clientMail;
    }
}

