<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * AppBundle\Entity\GuidanceFollowUpFile
 *
 * @ORM\Table(name="guidance_follow_up_file")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\GuidanceFollowUpFileRepository")
 * @ORM\HasLifecycleCallbacks
 */
class GuidanceFollowUpFile
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
     * @var smallint $guidance_follow_up
     * @ORM\ManyToOne(targetEntity="GuidanceFollowUp", inversedBy="files")
     */
    private $guidance_follow_up;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string $content
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @var string $archive
     *
     * @ORM\Column(name="archive", type="string", length=255)
     */
    private $archive;

    /**
     * @Assert\File(maxSize="6000000", mimeTypes={"application/pdf"})
     */
    protected $file;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;


    /**
     * @var int modified
     * @ORM\Column(name="modified", type="boolean", length=1, nullable=true)
     * Lo uso para, cuando se edita la entidad y sólo se modifica el archivo de archiven, indicar que se ha modificado
     * y persistir la entidad, porque el atributo file no se controla mediante doctrine porque no está en la bbdd
     */
    private $modified;


    public function __toString()
    {
        return $this->getName();
    }

    public function getAbsolutePath()
    {
        return null === $this->archive ? null : $this->getUploadRootDir() . '/' . $this->archive;
    }

    public function getWebPath()
    {
        return null === $this->archive ? null : $this->getUploadDir() . '/' . $this->archive;
    }

    protected function getUploadRootDir()
    {
        // la ruta absoluta del directorio donde se deben guardar los archivos cargados
        return __DIR__ . '/../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // se libra del __DIR__ para no desviarse al mostrar `doc/archive` en la vista.
        return 'uploads/student/guidance_follow_up_files';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            // haz cualquier cosa para generar un nombre único
            if ($this->archive !== null) {
                $this->removeUpload();
            }
            $this->archive = uniqid("", true) . '.' . $this->file->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        // la propiedad file puede estar vacía si el campo no es obligatorio
        if (null === $this->file) {
            return;
        }

        // si hay un error al mover el archivo, move() automáticamente
        // envía una excepción. Esta impedirá que la entidad se persista
        // en la base de datos en caso de error
        $this->file->move($this->getUploadRootDir(), $this->archive);

        unset($this->file);
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
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
     * @return GuidanceFollowUpFile
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
     * Set content.
     *
     * @param string|null $content
     *
     * @return GuidanceFollowUpFile
     */
    public function setContent($content = null)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content.
     *
     * @return string|null
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set archive.
     *
     * @param string $archive
     *
     * @return GuidanceFollowUpFile
     */
    public function setArchive($archive)
    {
        $this->archive = $archive;

        return $this;
    }

    /**
     * Get archive.
     *
     * @return string
     */
    public function getArchive()
    {
        return $this->archive;
    }

    /**
     * Set created.
     *
     * @param \DateTime $created
     *
     * @return GuidanceFollowUpFile
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created.
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated.
     *
     * @param \DateTime $updated
     *
     * @return GuidanceFollowUpFile
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated.
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set modified.
     *
     * @param bool|null $modified
     *
     * @return GuidanceFollowUpFile
     */
    public function setModified($modified = null)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified.
     *
     * @return bool|null
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * Set guidanceFollowUp.
     *
     * @param \AppBundle\Entity\GuidanceFollowUp|null $guidanceFollowUp
     *
     * @return GuidanceFollowUpFile
     */
    public function setGuidanceFollowUp(\AppBundle\Entity\GuidanceFollowUp $guidanceFollowUp = null)
    {
        $this->guidance_follow_up = $guidanceFollowUp;

        return $this;
    }

    /**
     * Get guidanceFollowUp.
     *
     * @return \AppBundle\Entity\GuidanceFollowUp|null
     */
    public function getGuidanceFollowUp()
    {
        return $this->guidance_follow_up;
    }
}
