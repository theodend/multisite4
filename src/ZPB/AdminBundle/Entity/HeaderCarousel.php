<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * HeaderCarousel
 *
 * @ORM\Table(name="zpb_header_carousels")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\HeaderCarouselRepository")
 */
class HeaderCarousel implements \JsonSerializable
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
     * @ORM\Column(name="site", type="string", length=50)
     */
    private $site;

    /**
     * @var integer
     *
     * @ORM\Column(name="duration", type="integer")
     */
    private $duration;

    /**
     * @ORM\OneToMany(targetEntity="ZPB\AdminBundle\Entity\HeaderCarouselSlide", mappedBy="slider")
     */
    private $slides;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->slides = new ArrayCollection();
        $this->duration = 10000;
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
     * Get site
     *
     * @return string
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set site
     *
     * @param string $site
     * @return HeaderCarousel
     */
    public function setSite($site)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     * @return HeaderCarousel
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Add slides
     *
     * @param HeaderCarouselSlide $slides
     * @return HeaderCarousel
     */
    public function addSlide(HeaderCarouselSlide $slides)
    {
        $this->slides[] = $slides;

        return $this;
    }

    /**
     * Remove slides
     *
     * @param HeaderCarouselSlide $slides
     */
    public function removeSlide(HeaderCarouselSlide $slides)
    {
        $this->slides->removeElement($slides);
    }

    /**
     * Get slides
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSlides()
    {
        return $this->slides;
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    function jsonSerialize()
    {
        return [
            "id"        => $this->id,
            "duration"  => $this->duration,
            "site"      => $this->site
        ];
    }
}
