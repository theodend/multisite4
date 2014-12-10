<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostStats
 *
 * @ORM\Table(name="zpb_stats_posts")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\PostStatsRepository")
 */
class PostStats
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
     * @ORM\Column(name="post_id", type="integer")
     */
    private $postId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="read_at", type="datetime")
     */
    private $readAt;


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
     * Set postId
     *
     * @param integer $postId
     * @return PostStats
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;

        return $this;
    }

    /**
     * Get postId
     *
     * @return integer
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Set readAt
     *
     * @param \DateTime $readAt
     * @return PostStats
     */
    public function setReadAt($readAt)
    {
        $this->readAt = $readAt;

        return $this;
    }

    /**
     * Get readAt
     *
     * @return \DateTime
     */
    public function getReadAt()
    {
        return $this->readAt;
    }
}
