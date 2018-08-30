<?php
/**
 * Created by diphda.net.
 * Sirve para distinguir los distintos tipos de cursos, 1º ESO, 2º ESO, 1º Bachillerato, etc
 *
 * User: paco
 * Date: 1/12/15
 * Time: 21:52
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * AppBundle\Entity\PenaltyType
 *
 * @ORM\Table(name="penalty_type")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\PenaltyTypeRepository")
 */
class PenaltyType
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Warning", mappedBy="penalty_type")
     */
    protected $warnings;


    /**
     * @var string $title
     * @Assert\NotBlank
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;




    public function __toString()
    {
        return $this->getTitle();
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->warnings = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return PenaltyType
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Add warning.
     *
     * @param \AppBundle\Entity\Warning $warning
     *
     * @return PenaltyType
     */
    public function addWarning(\AppBundle\Entity\Warning $warning)
    {
        $this->warnings[] = $warning;

        return $this;
    }

    /**
     * Remove warning.
     *
     * @param \AppBundle\Entity\Warning $warning
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeWarning(\AppBundle\Entity\Warning $warning)
    {
        return $this->warnings->removeElement($warning);
    }

    /**
     * Get warnings.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWarnings()
    {
        return $this->warnings;
    }
}
