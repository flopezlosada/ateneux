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
 * AppBundle\Entity\MajorOffenceType
 *
 * @ORM\Table(name="major_offence_type")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\MajorOffenceTypeRepository")
 */
class MajorOffenceType
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
     * @ORM\OneToMany(targetEntity="Warning", mappedBy="major_offence_type")
     */
    protected $warnings;


    /**
     * @var string $title
     * @Assert\NotBlank
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;


    /**
     * @var integer $warning_type
     * @Assert\NotBlank
     * @ORM\Column(name="warning_type", type="integer")
     */
    private $warning_type;

   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->warnings = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get warning type
     *
     * @return integer
     */
    public function getWarningType()
    {
        return $this->warning_type;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return WarningType
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get title with type
     *
     * @return string
     */
    public function getTitleWithType()
    {
        return '_'.$this->warning_type.'_'.$this->title;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return WarningType
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return WarningType
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Add warning
     *
     * @param \AppBundle\Entity\Warning $warning
     *
     * @return WarningType
     */
    public function addWarning(\AppBundle\Entity\Warning $warning)
    {
        $this->warnings[] = $warning;

        return $this;
    }

    /**
     * Remove warning
     *
     * @param \AppBundle\Entity\Warning $warning
     */
    public function removeWarning(\AppBundle\Entity\Warning $warning)
    {
        $this->warnings->removeElement($warning);
    }

    /**
     * Get warnings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWarnings()
    {
        return $this->warnings;
    }

    public function __toString()
    {
        return $this->getTitle();
    }


}
