<?php
namespace CharlesBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Surveillance
 *
 * @ORM\Table(name="surveillance")
 * @ORM\Entity(repositoryClass="CharlesBundle\Repository\SurveillanceRepository")
 */
class Surveillance
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
     * @var \DateTime
     *
     * @ORM\Column(name="srv_date", type="datetime")
     */
    private $srvDate;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="srv_duree", type="time")
     */
    private $srvDuree;
    /**
     * @var string
     *
     * @ORM\Column(name="srv_lieu", type="string", length=255)
     */
    private $srvLieu;
    /**
     * @var boolean
     *
     * @ORM\Column(name="srv_valide", type="boolean")
     */
    private $srvValide;
    /**
     * @ORM\ManyToOne(targetEntity=Nounou::class)
     */
    protected $nounou;
    /**
     * @ORM\ManyToOne(targetEntity=Client::class)
     */
    protected $client;
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
     * Set srvDate
     *
     * @param \DateTime $srvDate
     *
     * @return Surveillance
     */
    public function setSrvDate($srvDate)
    {
        $this->srvDate = $srvDate;
        return $this;
    }
    /**
     * Get srvDate
     *
     * @return \DateTime
     */
    public function getSrvDate()
    {
        return $this->srvDate;
    }
    /**
     * Set srvDuree
     *
     * @param \DateTime $srvDuree
     *
     * @return Surveillance
     */
    public function setSrvDuree($srvDuree)
    {
        $this->srvDuree = $srvDuree;
        return $this;
    }
    /**
     * Get srvDuree
     *
     * @return \DateTime
     */
    public function getSrvDuree()
    {
        return $this->srvDuree;
    }
    /**
     * Set srvLieu
     *
     * @param string $srvLieu
     *
     * @return Surveillance
     */
    public function setSrvLieu($srvLieu)
    {
        $this->srvLieu = $srvLieu;
        return $this;
    }
    /**
     * Get srvLieu
     *
     * @return string
     */
    public function getSrvLieu()
    {
        return $this->srvLieu;
    }
    /**
     * Set srvValide
     *
     * @param boolean $srvValide
     *
     * @return Surveillance
     */
    public function setSrvValide($srvValide)
    {
        $this->srvValide = $srvValide;
        return $this;
    }
    /**
     * Get srvValide
     *
     * @return boolean
     */
    public function getSrvValide()
    {
        return $this->srvValide;
    }
    /**
     * Get clientId
     *
     * @return string
     */
    public function getClient()
    {
        return $this->client;
    }
    /**
     * Get nounou
     *
     * @return string
     */
    public function getNounou()
    {
        return $this->nounou;
    }
}
