<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * FAQ
 *
 * @ORM\Table(name="zpb_faqs")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\FAQRepository")
 */
class FAQ implements \JsonSerializable
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
     * @ORM\Column(name="question", type="text")
     */
    private $question;

    /**
     * @var string
     * @Assert\NotBlank(message="Ce champs est requis.")
     * @ORM\Column(name="response", type="text")
     */
    private $response;

    /**
     * @ORM\ManyToOne(targetEntity="ZPB\AdminBundle\Entity\Site", inversedBy="faqs")
     * @ORM\JoinColumn(name="site_id", referencedColumnName="id")
     */
    private $site;

    public function jsonSerialize()
    {
        return [
            "id"       => $this->getId(),
            "question" => $this->getQuestion(),
            "response" => $this->getResponse(),
            "site"     => $this->getSite()
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
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set question
     *
     * @param string $question
     * @return FAQ
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get response
     *
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set response
     *
     * @param string $response
     * @return FAQ
     */
    public function setResponse($response)
    {
        $this->response = $response;

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

    /**
     * Set site
     *
     * @param Site $site
     * @return FAQ
     */
    public function setSite(Site $site = null)
    {
        $this->site = $site;

        return $this;
    }
}
