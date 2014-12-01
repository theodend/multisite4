<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * ImageGallery
 *
 * @ORM\Table(name="image_galleres")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\ImageGalleryRepository")
 */
class ImageGallery implements \JsonSerializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="template", type="string", length=255, nullable=true)
     */
    private $template;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     * @Gedmo\Slug(fields={"name"})
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="ZPB\AdminBundle\Entity\ImageGalleryImage", mappedBy="gallery")
     */
    private $images;

    /**
     * @ORM\Column(name="is_private", type="boolean")
     */
    private $isPrivate;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->isPrivate = false;
    }

    /**
     * Add images
     *
     * @param ImageGalleryImage $images
     * @return ImageGallery
     */
    public function addImage(ImageGalleryImage $images)
    {
        $this->images[] = $images;

        return $this;
    }

    /**
     * Remove images
     *
     * @param ImageGalleryImage $images
     */
    public function removeImage(ImageGalleryImage $images)
    {
        $this->images->removeElement($images);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    function jsonSerialize()
    {
        return [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "template" => $this->getTemplate(),
            "slug" => $this->getSlug()
        ];
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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return ImageGallery
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get template
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Set template
     *
     * @param string $template
     * @return ImageGallery
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return ImageGallery
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsPrivate()
    {
        return $this->isPrivate;
    }

    /**
     * @param mixed $isPrivate
     * @return ImageGallery
     */
    public function setIsPrivate($isPrivate)
    {
        $this->isPrivate = $isPrivate;
        return $this;
    }


}
