<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GalleryToSite
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\GalleryToSiteRepository")
 */
class GalleryToSite
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
     * @var integer
     *
     * @ORM\Column(name="gallery_id", type="integer")
     */
    private $galleryId;

    /**
     * @var string
     *
     * @ORM\Column(name="site_shortcut", type="string", length=10)
     */
    private $siteShortcut;


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
     * Set galleryId
     *
     * @param integer $galleryId
     * @return GalleryToSite
     */
    public function setGalleryId($galleryId)
    {
        $this->galleryId = $galleryId;

        return $this;
    }

    /**
     * Get galleryId
     *
     * @return integer 
     */
    public function getGalleryId()
    {
        return $this->galleryId;
    }

    /**
     * Set siteShortcut
     *
     * @param string $siteShortcut
     * @return GalleryToSite
     */
    public function setSiteShortcut($siteShortcut)
    {
        $this->siteShortcut = $siteShortcut;

        return $this;
    }

    /**
     * Get siteShortcut
     *
     * @return string 
     */
    public function getSiteShortcut()
    {
        return $this->siteShortcut;
    }
}
