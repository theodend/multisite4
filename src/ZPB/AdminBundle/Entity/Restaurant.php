<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Restaurant
 *
 * @ORM\Table(name="zpb_restaurants")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\RestaurantRepository")
 */
class Restaurant implements \JsonSerializable
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
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     * @Gedmo\Slug(fields={"name"}, unique=true)
     */
    private $slug;

    /**
     * @var integer
     *
     * @ORM\Column(name="num", type="integer")
     */
    private $num;

    /**
     * @var integer
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     */
    private $image;

    /**
     * @ORM\Column(name="thumb", type="string", nullable=false)
     */
    private $thumb;

    /**
     * @ORM\Column(name="image_root", type="string", nullable=false)
     */
    private $imageRoot;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_open", type="boolean")
     */
    private $isOpen;

    public function __construct()
    {
        $this->isOpen = false;
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
     * @return Restaurant
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Restaurant
     */
    public function setDescription($description)
    {
        $this->description = $description;

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
     * @return Restaurant
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get num
     *
     * @return integer
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Set num
     *
     * @param integer $num
     * @return Restaurant
     */
    public function setNum($num)
    {
        $this->num = $num;

        return $this;
    }

    /**
     * Get isOpen
     *
     * @return boolean
     */
    public function getIsOpen()
    {
        return $this->isOpen;
    }

    /**
     * Set isOpen
     *
     * @param boolean $isOpen
     * @return Restaurant
     */
    public function setIsOpen($isOpen)
    {
        $this->isOpen = $isOpen;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Restaurant
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImageRoot()
    {
        return $this->imageRoot;
    }

    /**
     * @param mixed $imageRoot
     * @return Restaurant
     */
    public function setImageRoot($imageRoot)
    {
        $this->imageRoot = $imageRoot;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getThumb()
    {
        return $this->thumb;
    }

    /**
     * @param mixed $thumb
     * @return Restaurant
     */
    public function setThumb($thumb)
    {
        $this->thumb = $thumb;

        return $this;
    }

    function jsonSerialize()
    {
        return [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "description" => $this->getDescription(),
            "slug" => $this->getSlug(),
            "num" => $this->getNum(),
            "image" => $this->getImage(),
            "thumb" => $this->getThumb(),
            "imageRoot" => $this->getImageRoot(),
            "isOpen" => $this->getIsOpen(),
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
}
