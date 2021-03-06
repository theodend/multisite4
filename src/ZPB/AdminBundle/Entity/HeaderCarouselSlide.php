<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * HeaderCarouselSlide
 *
 * @ORM\Table(name="zpb_header_carousel_slides")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\HeaderCarouselSlideRepository")
 */
class HeaderCarouselSlide implements \JsonSerializable
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
     * @ORM\Column(name="root_dir", type="string", length=255)
     */
    private $rootDir;

    /**
     * @var string
     *
     * @ORM\Column(name="web_root", type="string", length=255)
     */
    private $webRoot;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @var integer
     *
     * @Gedmo\SortablePosition()
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @Gedmo\SortableGroup()
     * @ORM\ManyToOne(targetEntity="ZPB\AdminBundle\Entity\HeaderCarousel", inversedBy="slides")
     * @ORM\JoinColumn(name="slider_id", referencedColumnName="id")
     */
    private $slider;


    public function __construct()
    {
        $this->isActive = false;

    }

    public function jsonSerialize()
    {
        return [
            "id" => $this->getId(),
            "title" => $this->getTitle(),
            "isActive" => $this->getIsActive(),
            "position" => $this->getPosition(),
            "rootDir" => $this->getRootDir(),
            "webRoot" => $this->getWebRoot(),
            "slider" => $this->getSlider()->getId()
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
     * @return HeaderCarouselSlide
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

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
     * @return HeaderCarouselSlide
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

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
     * @return HeaderCarouselSlide
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get rootDir
     *
     * @return string
     */
    public function getRootDir()
    {
        return $this->rootDir;
    }

    /**
     * Set rootDir
     *
     * @param string $rootDir
     * @return HeaderCarouselSlide
     */
    public function setRootDir($rootDir)
    {
        $this->rootDir = $rootDir;

        return $this;
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
     * @return HeaderCarouselSlide
     */
    public function setWebRoot($webRoot)
    {
        $this->webRoot = $webRoot;

        return $this;
    }

    /**
     * Get slider
     *
     * @return HeaderCarousel
     */
    public function getSlider()
    {
        return $this->slider;
    }

    /**
     * Set slider
     *
     * @param HeaderCarousel $slider
     * @return HeaderCarouselSlide
     */
    public function setSlider(HeaderCarousel $slider = null)
    {
        $this->slider = $slider;

        return $this;
    }
}
