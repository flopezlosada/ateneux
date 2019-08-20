<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * AppBundle\Entity\GuidanceFollowUpStatus
 * @ORM\Table(name="guidance_follow_up_status")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\GuidanceFollowUpStatusRepository")
 */
class GuidanceFollowUpStatus
{
  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @Assert\NotBlank
   * @var string $name
   * @ORM\Column(name="name", type="string", length=255)
   */
  private $name;

  /**
   * @ORM\OneToMany(targetEntity="GuidanceFollowUp", mappedBy="guidance_follow_up_status")
   */
  protected $guidance_follow_ups;
   


    
    public function __toString()
    {
      return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->guidance_follow_ups = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name.
     *
     * @param string $name
     *
     * @return GuidanceFollowUpStatus
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add guidanceFollowUp.
     *
     * @param \AppBundle\Entity\GuidanceFollowUp $guidanceFollowUp
     *
     * @return GuidanceFollowUpStatus
     */
    public function addGuidanceFollowUp(\AppBundle\Entity\GuidanceFollowUp $guidanceFollowUp)
    {
        $this->guidance_follow_ups[] = $guidanceFollowUp;

        return $this;
    }

    /**
     * Remove guidanceFollowUp.
     *
     * @param \AppBundle\Entity\GuidanceFollowUp $guidanceFollowUp
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeGuidanceFollowUp(\AppBundle\Entity\GuidanceFollowUp $guidanceFollowUp)
    {
        return $this->guidance_follow_ups->removeElement($guidanceFollowUp);
    }

    /**
     * Get guidanceFollowUps.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGuidanceFollowUps()
    {
        return $this->guidance_follow_ups;
    }
}
