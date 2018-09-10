<?php
/**
 * Created by diphda.net.
 * Tipos de Adaptación Curricular
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
 * AppBundle\Entity\ProceduralType
 *
 * @ORM\Table(name="procedural_type")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ProceduralTypeRepository")
 */
class ProceduralType
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
     * @ORM\OneToMany(targetEntity="StudentSchool", mappedBy="procedural_type")
     */
    protected $students_school;


    /**
     * @var string $title
     * @Assert\NotBlank
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;


    /**
     * Constructor
     */

    public function __toString()
    {
        return $this->getTitle();
    }

    public function getTitle()
    {
        return $this->title;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->students_school = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ProceduralType
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }


    /**
     * Add studentsSchool.
     *
     * @param \AppBundle\Entity\StudentSchool $studentsSchool
     *
     * @return ProceduralType
     */
    public function addStudentsSchool(\AppBundle\Entity\StudentSchool $studentsSchool)
    {
        $this->students_school[] = $studentsSchool;

        return $this;
    }

    /**
     * Remove studentsSchool.
     *
     * @param \AppBundle\Entity\StudentSchool $studentsSchool
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeStudentsSchool(\AppBundle\Entity\StudentSchool $studentsSchool)
    {
        return $this->students_school->removeElement($studentsSchool);
    }

    /**
     * Get studentsSchool.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStudentsSchool()
    {
        return $this->students_school;
    }
}
