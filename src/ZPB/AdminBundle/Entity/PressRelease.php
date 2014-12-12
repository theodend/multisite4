<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * PressRelease
 *
 * @ORM\Table(name="zpb_press_releases")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\PressReleaseRepository")
 */
class PressRelease
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
     * @Assert\NotBlank(message="Ce champs est requis.")
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="update_at", type="datetime")
     */
    private $updateAt;

    /**
     * @var string
     * @Assert\NotBlank(message="Ce champs est requis.")
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="root_dir", type="string", length=255)
     */
    private $rootDir;

    /**
     * @var string
     * @Assert\NotBlank(message="Ce champs est requis.")
     * @ORM\Column(name="pdf_fr", type="string", length=255)
     */
    private $pdfFr;

    /**
     * @var string
     *
     * @ORM\Column(name="pdf_en", type="string", length=255, nullable=true)
     */
    private $pdfEn;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="ZPB\AdminBundle\Entity\Site", inversedBy="pressReleases")
     * @ORM\JoinColumn(name="site_id", referencedColumnName="id")
     */
    private $site;


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
     * Set title
     *
     * @param string $title
     * @return PressRelease
     */
    public function setTitle($title)
    {
        $this->title = $title;

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
     * Set slug
     *
     * @param string $slug
     * @return PressRelease
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return PressRelease
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     * @return PressRelease
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime 
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return PressRelease
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set rootDir
     *
     * @param string $rootDir
     * @return PressRelease
     */
    public function setRootDir($rootDir)
    {
        $this->rootDir = $rootDir;

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
     * Set pdfFr
     *
     * @param string $pdfFr
     * @return PressRelease
     */
    public function setPdfFr($pdfFr)
    {
        $this->pdfFr = $pdfFr;

        return $this;
    }

    /**
     * Get pdfFr
     *
     * @return string 
     */
    public function getPdfFr()
    {
        return $this->pdfFr;
    }

    /**
     * Set pdfEn
     *
     * @param string $pdfEn
     * @return PressRelease
     */
    public function setPdfEn($pdfEn)
    {
        $this->pdfEn = $pdfEn;

        return $this;
    }

    /**
     * Get pdfEn
     *
     * @return string 
     */
    public function getPdfEn()
    {
        return $this->pdfEn;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return PressRelease
     */
    public function setImage($image)
    {
        $this->image = $image;

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
     * Set site
     *
     * @param Site $site
     * @return PressRelease
     */
    public function setSite(Site $site = null)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return Site
     */
    public function getSite()
    {
        return $this->site;
    }
}
