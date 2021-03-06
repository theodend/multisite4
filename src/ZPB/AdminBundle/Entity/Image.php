<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(name="zpb_photos")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\ImageRepository")
 */
class Image implements \JsonSerializable
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
     * @ORM\Column(name="long_id", type="string", length=255)
     */
    private $longId;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255)
     */
    private $filename;

    /**
     * @ORM\Column(name="width", type="integer")
     */
    private $width;

    /**
     * @ORM\Column(name="height", type="integer")
     */
    private $height;

    /**
     * @ORM\Column(name="title", type="text", nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(name="copyright", type="string", nullable=true)
     */
    private $copyright;

    /**
     * @ORM\Column(name="mime", type="string")
     */
    private $mime;

    /**
     * @ORM\Column(name="extension", type="string")
     */
    private $extension;

    public function __construct()
    {
        $now = (new \DateTime())->getTimestamp();
        $this->longId = substr(base_convert(sha1(uniqid($now, true)), 16, 36), 0, 15);
    }

    public function jsonSerialize()
    {
        return [
            "id"        => $this->getId(),
            "longId"    => $this->getLongId(),
            "width"     => $this->getWidth(),
            "height"    => $this->getHeight(),
            "filename"  => $this->getFilename(),
            "mime"      => $this->getMime(),
            "extension" => $this->getExtension(),
            "copyright" => $this->getCopyright(),
            "title"     => $this->getTitle()
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
     * Get longId
     *
     * @return string
     */
    public function getLongId()
    {
        return $this->longId;
    }

    /**
     * Set longId
     *
     * @param string $longId
     * @return Image
     */
    public function setLongId($longId)
    {
        $this->longId = $longId;

        return $this;
    }

    /**
     * Get width
     *
     * @return integer
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set width
     *
     * @param integer $width
     * @return Image
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get height
     *
     * @return integer
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set height
     *
     * @param integer $height
     * @return Image
     */
    public function setHeight($height)
    {
        $this->height = $height;

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
     * Set filename
     *
     * @param string $filename
     * @return Image
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get mime
     *
     * @return string
     */
    public function getMime()
    {
        return $this->mime;
    }

    /**
     * Set mime
     *
     * @param string $mime
     * @return Image
     */
    public function setMime($mime)
    {
        $this->mime = $mime;

        return $this;
    }

    /**
     * Get extension
     *
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set extension
     *
     * @param string $extension
     * @return Image
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

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
     * @return Image
     */
    public function setCopyright($copyright)
    {
        $this->copyright = $copyright;

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
     * @return Image
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
}
