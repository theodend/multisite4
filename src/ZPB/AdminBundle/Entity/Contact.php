<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Contact
 *
 * @ORM\Table(name="zpb_contact")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\ContactRepository")
 */
class Contact
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
     * @ORM\Column(name="interlocutor", type="string", length=100)
     */
    private $interlocutor;

    /**
     * @var string
     * @Assert\Email(checkHost=true, checkMX=true, message="Ce n'est pas une adresse email valide.")
     * @Assert\NotBlank(message="Ce champs est requis")
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(name="topic", type="string", length=255)
     */
    private $topic;

    /**
     * @var string
     * @Assert\Regex("/^[a-zàéèêëûüîïôöçù0-9,;:!\$%?.&#+=\/\'\s\n\r_-]+$/i", message="Ce champs contient des caractères non autorisés")
     * @Assert\NotBlank(message="Ce champs est requis")
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_send", type="boolean")
     */
    private $isSend;


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
     * Set interlocutor
     *
     * @param string $interlocutor
     * @return Contact
     */
    public function setInterlocutor($interlocutor)
    {
        $this->interlocutor = $interlocutor;

        return $this;
    }

    /**
     * Get interlocutor
     *
     * @return string
     */
    public function getInterlocutor()
    {
        return $this->interlocutor;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set topic
     *
     * @param string $topic
     * @return Contact
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get topic
     *
     * @return string
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return Contact
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Contact
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
     * Set isSend
     *
     * @param boolean $isSend
     * @return Contact
     */
    public function setIsSend($isSend)
    {
        $this->isSend = $isSend;

        return $this;
    }

    /**
     * Get isSend
     *
     * @return boolean
     */
    public function getIsSend()
    {
        return $this->isSend;
    }
}
