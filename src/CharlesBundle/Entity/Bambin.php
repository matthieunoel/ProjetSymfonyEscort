<?php

namespace CharlesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bambin
 *
 * @ORM\Table(name="bambin")
 * @ORM\Entity(repositoryClass="CharlesBundle\Repository\BambinRepository")
 */
class Bambin
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
     * @ORM\Column(name="bambin_nom", type="string", length=255)
     */
    private $bambinNom;

    /**
     * @var string
     *
     * @ORM\Column(name="bambin_prenom", type="string", length=255)
     */
    private $bambinPrenom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="bambin_datenaiss", type="date")
     */
    private $bambinDatenaiss;

    /**
     * @var int
     *
     * @ORM\Column(name="bambin_sexe", type="integer")
     */
    private $bambinSexe;

    /**
     * @var string
     *
     * @ORM\Column(name="bambin_details", type="string", length=1020)
     */
    private $bambinDetails;

    /**
     * @var string
     *
     * @ORM\Column(name="client_id", type="integer")
     */
    protected $client_id;


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
     * Get clientid
     *
     * @return int
     */
    public function getClientId()
    {
        return $this ->client_id;
    }

    /**
     * Set bambinNom
     *
     * @param string $bambinNom
     *
     * @return Bambin
     */
    public function setBambinNom($bambinNom)
    {
        $this->bambinNom = $bambinNom;

        return $this;
    }

    /**
     * Get bambinNom
     *
     * @return string
     */
    public function getBambinNom()
    {
        return $this->bambinNom;
    }

    /**
     * Set bambinPrenom
     *
     * @param string $bambinPrenom
     *
     * @return Bambin
     */
    public function setBambinPrenom($bambinPrenom)
    {
        $this->bambinPrenom = $bambinPrenom;

        return $this;
    }

    /**
     * Get bambinPrenom
     *
     * @return string
     */
    public function getBambinPrenom()
    {
        return $this->bambinPrenom;
    }

    /**
     * Set bambinDatenaiss
     *
     * @param \DateTime $bambinDatenaiss
     *
     * @return Bambin
     */
    public function setBambinDatenaiss($bambinDatenaiss)
    {
        $this->bambinDatenaiss = $bambinDatenaiss;

        return $this;
    }

    /**
     * Get bambinDatenaiss
     *
     * @return \DateTime
     */
    public function getBambinDatenaiss()
    {
        return $this->bambinDatenaiss;
    }

    /**
     * Set bambinSexe
     *
     * @param integer $bambinSexe
     *
     * @return Bambin
     */
    public function setBambinSexe($bambinSexe)
    {
        $this->bambinSexe = $bambinSexe;

        return $this;
    }

    /**
     * Get bambinSexe
     *
     * @return int
     */
    public function getBambinSexe()
    {
        return $this->bambinSexe;
    }

    /**
     * Set bambinDetails
     *
     * @param string $bambinDetails
     *
     * @return Bambin
     */
    public function setBambinDetails($bambinDetails)
    {
        $this->bambinDetails = $bambinDetails;

        return $this;
    }

    /**
     * Get bambinDetails
     *
     * @return string
     */
    public function getBambinDetails()
    {
        return $this->bambinDetails;
    }
}

