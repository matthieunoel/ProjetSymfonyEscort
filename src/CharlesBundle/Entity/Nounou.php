<?php

namespace CharlesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nounou
 *
 * @ORM\Table(name="nounou")
 * @ORM\Entity(repositoryClass="CharlesBundle\Repository\NounouRepository")
 */
class Nounou
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
     * @ORM\Column(name="nounou_nom", type="string", length=255)
     */
    private $nounouNom;

    /**
     * @var string
     *
     * @ORM\Column(name="nounou_prenom", type="string", length=255)
     */
    private $nounouPrenom;

    /**
     * @var string
     *
     * @ORM\Column(name="nounou_mdp", type="string", length=255)
     */
    private $nounouMdp;

    /**
     * @var string
     *
     * @ORM\Column(name="nounou_mail", type="string", length=255, unique=true)
     */
    private $nounouMail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="nounou_datenaiss", type="date")
     */
    private $nounouDatenaiss;

    /**
     * @var float
     *
     * @ORM\Column(name="nounou_tarif", type="float")
     */
    private $nounouTarif;

    /**
     * @var string
     *
     * @ORM\Column(name="nounou_desc", type="string", length=1020)
     */
    private $nounouDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="nounou_adresse", type="string", length=255)
     */
    private $nounouAdresse;

    /**
     * @var string
     *
     * @ORM\Column(name="nounou_tel_pro", type="string", length=15)
     */
    private $nounouTelPro;

    /**
     * @var string
     *
     * @ORM\Column(name="nounou_tel_perso", type="string", length=15)
     */
    private $nounouTelPerso;

    /**
     * @var string
     *
     * @ORM\Column(name="nounou_photo", type="string", length=255, nullable=true)
     */
    private $nounouPhoto;

    /**
     * @var int
     *
     * @ORM\Column(name="nounou_sexe", type="integer")
     */
    private $nounouSexe;


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
     * Set nounouNom
     *
     * @param string $nounouNom
     *
     * @return Nounou
     */
    public function setNounouNom($nounouNom)
    {
        $this->nounouNom = $nounouNom;

        return $this;
    }

    /**
     * Get nounouNom
     *
     * @return string
     */
    public function getNounouNom()
    {
        return $this->nounouNom;
    }

    /**
     * Set nounouPrenom
     *
     * @param string $nounouPrenom
     *
     * @return Nounou
     */
    public function setNounouPrenom($nounouPrenom)
    {
        $this->nounouPrenom = $nounouPrenom;

        return $this;
    }

    /**
     * Get nounouPrenom
     *
     * @return string
     */
    public function getNounouPrenom()
    {
        return $this->nounouPrenom;
    }

    /**
     * Set nounouMdp
     *
     * @param string $nounouMdp
     *
     * @return Nounou
     */
    public function setNounouMdp($nounouMdp)
    {
        $this->nounouMdp = $nounouMdp;

        return $this;
    }

    /**
     * Get nounouMdp
     *
     * @return string
     */
    public function getNounouMdp()
    {
        return $this->nounouMdp;
    }

    /**
     * Set nounouMail
     *
     * @param string $nounouMail
     *
     * @return Nounou
     */
    public function setNounouMail($nounouMail)
    {
        $this->nounouMail = $nounouMail;

        return $this;
    }

    /**
     * Get nounouMail
     *
     * @return string
     */
    public function getNounouMail()
    {
        return $this->nounouMail;
    }

    /**
     * Set nounouDatenaiss
     *
     * @param \DateTime $nounouDatenaiss
     *
     * @return Nounou
     */
    public function setNounouDatenaiss($nounouDatenaiss)
    {
        $this->nounouDatenaiss = $nounouDatenaiss;

        return $this;
    }

    /**
     * Get nounouDatenaiss
     *
     * @return \DateTime
     */
    public function getNounouDatenaiss()
    {
        return $this->nounouDatenaiss;
    }

    /**
     * Set nounouTarif
     *
     * @param float $nounouTarif
     *
     * @return Nounou
     */
    public function setNounouTarif($nounouTarif)
    {
        $this->nounouTarif = $nounouTarif;

        return $this;
    }

    /**
     * Get nounouTarif
     *
     * @return float
     */
    public function getNounouTarif()
    {
        return $this->nounouTarif;
    }

    /**
     * Set nounouDesc
     *
     * @param string $nounouDesc
     *
     * @return Nounou
     */
    public function setNounouDesc($nounouDesc)
    {
        $this->nounouDesc = $nounouDesc;

        return $this;
    }

    /**
     * Get nounouDesc
     *
     * @return string
     */
    public function getNounouDesc()
    {
        return $this->nounouDesc;
    }

    /**
     * Set nounouAdresse
     *
     * @param string $nounouAdresse
     *
     * @return Nounou
     */
    public function setNounouAdresse($nounouAdresse)
    {
        $this->nounouAdresse = $nounouAdresse;

        return $this;
    }

    /**
     * Get nounouAdresse
     *
     * @return string
     */
    public function getNounouAdresse()
    {
        return $this->nounouAdresse;
    }

    /**
     * Set nounouTelPro
     *
     * @param string $nounouTelPro
     *
     * @return Nounou
     */
    public function setNounouTelPro($nounouTelPro)
    {
        $this->nounouTelPro = $nounouTelPro;

        return $this;
    }

    /**
     * Get nounouTelPro
     *
     * @return string
     */
    public function getNounouTelPro()
    {
        return $this->nounouTelPro;
    }

    /**
     * Set nounouTelPerso
     *
     * @param string $nounouTelPerso
     *
     * @return Nounou
     */
    public function setNounouTelPerso($nounouTelPerso)
    {
        $this->nounouTelPerso = $nounouTelPerso;

        return $this;
    }

    /**
     * Get nounouTelPerso
     *
     * @return string
     */
    public function getNounouTelPerso()
    {
        return $this->nounouTelPerso;
    }

    /**
     * Set nounouPhoto
     *
     * @param string $nounouPhoto
     *
     * @return Nounou
     */
    public function setNounouPhoto($nounouPhoto)
    {
        $this->nounouPhoto = $nounouPhoto;

        return $this;
    }

    /**
     * Get nounouPhoto
     *
     * @return string
     */
    public function getNounouPhoto()
    {
        return $this->nounouPhoto;
    }

    /**
     * Set nounouSexe
     *
     * @param integer $nounouSexe
     *
     * @return Nounou
     */
    public function setNounouSexe($nounouSexe)
    {
        $this->nounouSexe = $nounouSexe;

        return $this;
    }

    /**
     * Get nounouSexe
     *
     * @return int
     */
    public function getNounouSexe()
    {
        return $this->nounouSexe;
    }
}

