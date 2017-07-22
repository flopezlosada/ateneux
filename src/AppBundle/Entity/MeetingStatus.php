<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * AppBundle\Entity\MeetingStatus
 * @ORM\Table(name="meeting_status")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\MeetingStatusRepository")
 */
class MeetingStatus
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
   * @ORM\OneToMany(targetEntity="Meeting", mappedBy="meeting_status")
   */
  protected $meetings;
   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->meetings = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return MeetingStatus
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add meetings
     *
     * @param \AppBundle\Entity\Meeting $meetings
     * @return MeetingStatus
     */
    public function addMeeting(\AppBundle\Entity\Meeting $meetings)
    {
        $this->meetings[] = $meetings;
    
        return $this;
    }

    /**
     * Remove meetings
     *
     * @param \AppBundle\Entity\Meeting $meetings
     */
    public function removeMeeting(\AppBundle\Entity\Meeting $meetings)
    {
        $this->meetings->removeElement($meetings);
    }

    /**
     * Get meetings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMeetings()
    {
        return $this->meetings;
    }
    
    public function __toString()
    {
      return $this->name;
    }
}
