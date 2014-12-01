<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * ImageGalleryImage
 *
 * @ORM\Table(name="image_gallery_images")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\ImageGalleryImageRepository")
 */
class ImageGalleryImage implements \JsonSerializable
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
     * @ORM\Column(name="web_root", type="string", length=255)
     */
    private $webRoot;

    /**
     * @var string
     *
     * @ORM\Column(name="root", type="string", length=255)
     */
    private $root;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="copyright", type="string", length=255)
     */
    private $copyright;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @var integer
     * @Gedmo\SortablePosition
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity="ZPB\AdminBundle\Entity\ImageGallery", inversedBy="images")
     * @ORM\JoinColumn(name="gallery_id", referencedColumnName="id")
     * @Gedmo\SortableGroup
     */
    private $gallery;

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return ImageGalleryImage
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function __construct()
    {
        $this->isActive = false;
    }

    public function jsonSerialize()
    {
        return [
            "id" => $this->getId(),
            "webroot" => $this->getWebRoot(),
            "root" => $this->getRoot(),
            "gallery" => $this->getGallery(),
            "position" => $this->getPosition(),
            "title" => $this->getTitle(),
            "copyright" => $this->getCopyright()
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
     * Get webRoot
     *
     * @return string
     */
    public function getWebRoot()
    {
        return $this->webRoot;
    }

    /**
     * Set webRoot
     *
     * @param string $webRoot
     * @return ImageGalleryImage
     */
    public function setWebRoot($webRoot)
    {
        $this->webRoot = $webRoot;

        return $this;
    }

    /**
     * Get root
     *
     * @return string
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Set root
     *
     * @param string $root
     * @return ImageGalleryImage
     */
    public function setRoot($root)
    {
        $this->root = $root;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return ImageGallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * Set gallery
     *
     * @param ImageGallery $gallery
     * @return ImageGalleryImage
     */
    public function setGallery(ImageGallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return ImageGalleryImage
     */
    public function setPosition($position)
    {
        $this->position = $position;

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
     * Set title
     *
     * @param string $title
     * @return ImageGalleryImage
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get copyright
     *
     * @return string
     */
    public function getCopyright()
    {
        return $this->copyright;
    }

    /**
     * Set copyright
     *
     * @param string $copyright
     * @return ImageGalleryImage
     */
    public function setCopyright($copyright)
    {
        $this->copyright = $copyright;

        return $this;
    }
}
