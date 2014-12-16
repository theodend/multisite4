<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * PdfStat
 *
 * @ORM\Table(name="zpb_pdf_stats")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\PdfStatRepository")
 */
class PdfStat
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
     * @ORM\Column(name="pdf_id", type="integer")
     */
    private $pdfId;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255)
     */
    private $filename;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="site", type="string", length=20)
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
     * Set pdfId
     *
     * @param integer $pdfId
     * @return PdfStat
     */
    public function setPdfId($pdfId)
    {
        $this->pdfId = $pdfId;

        return $this;
    }

    /**
     * Get pdfId
     *
     * @return integer 
     */
    public function getPdfId()
    {
        return $this->pdfId;
    }

    /**
     * Set filename
     *
     * @param string $filename
     * @return PdfStat
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return PdfStat
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
     * Set site
     *
     * @param string $site
     * @return PdfStat
     */
    public function setSite($site)
    {
        $this->site = $site;

        return $this;
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
}
