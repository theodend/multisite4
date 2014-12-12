<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Site
 *
 * @ORM\Table(name="zpb_sites")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\SiteRepository")
 */
class Site implements \JsonSerializable
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
     * @ORM\Column(name="shortname", type="string", length=5)
     */
    private $shortname;

    /**
     * @var string
     *
     * @ORM\Column(name="route", type="string", length=100, nullable=true)
     */
    private $route;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @ORM\ManyToMany(targetEntity="ZPB\AdminBundle\Entity\PublishPost", mappedBy="sites")
     */
    private $posts;

    /**
     * @ORM\OneToMany(targetEntity="ZPB\AdminBundle\Entity\FAQ", mappedBy="site")
     */
    private $faqs;

    /**
     * @ORM\OneToMany(targetEntity="ZPB\AdminBundle\Entity\PressRelease", mappedBy="site")
     */
    private $pressReleases;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->faqs = new ArrayCollection();
        $this->pressReleases = new ArrayCollection();
    }

    function jsonSerialize()
    {
        return [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "shortname" => $this->getShortname(),
            "route" => $this->getRoute(),
            "url" => $this->getUrl(),
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
     * @return Site
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get shortname
     *
     * @return string
     */
    public function getShortname()
    {
        return $this->shortname;
    }

    /**
     * Set shortname
     *
     * @param string $shortname
     * @return Site
     */
    public function setShortname($shortname)
    {
        $this->shortname = $shortname;

        return $this;
    }

    /**
     * Get route
     *
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set route
     *
     * @param string $route
     * @return Site
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Site
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Add posts
     *
     * @param PublishPost $posts
     * @return Site
     */
    public function addPost(PublishPost $posts)
    {
        $this->posts[] = $posts;

        return $this;
    }

    /**
     * Remove posts
     *
     * @param PublishPost $posts
     */
    public function removePost(PublishPost $posts)
    {
        $this->posts->removeElement($posts);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Add faqs
     *
     * @param FAQ $faqs
     * @return Site
     */
    public function addFaq(FAQ $faqs)
    {
        $this->faqs[] = $faqs;

        return $this;
    }

    /**
     * Remove faqs
     *
     * @param FAQ $faqs
     */
    public function removeFaq(FAQ $faqs)
    {
        $this->faqs->removeElement($faqs);
    }

    /**
     * Get faqs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFaqs()
    {
        return $this->faqs;
    }

    /**
     * Add pressReleases
     *
     * @param PressRelease $pressReleases
     * @return Site
     */
    public function addPressRelease(PressRelease $pressReleases)
    {
        $this->pressReleases[] = $pressReleases;

        return $this;
    }

    /**
     * Remove pressReleases
     *
     * @param PressRelease $pressReleases
     */
    public function removePressRelease(PressRelease $pressReleases)
    {
        $this->pressReleases->removeElement($pressReleases);
    }

    /**
     * Get pressReleases
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPressReleases()
    {
        return $this->pressReleases;
    }
}
