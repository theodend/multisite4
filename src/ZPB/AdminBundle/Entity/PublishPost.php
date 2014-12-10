<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * PublishPost
 *
 * @ORM\Table(name="zpb_post_published")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\PublishPostRepository")
 */
class PublishPost
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
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * @ORM\OneToOne(targetEntity="ZPB\AdminBundle\Entity\Post")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     */
    private $post;

    /**
     * @ORM\Column(name="target_site", type="string", length=15, nullable=false)
     */
    private $targetSite;

    /**
     * @ORM\ManyToOne(targetEntity="ZPB\AdminBundle\Entity\PostCategory", inversedBy="posts")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    public function __construct()
    {
        $this->targetSite = "zoo";
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
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return PublishPost
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return PublishPost
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get post
     *
     * @return Post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set post
     *
     * @param Post $post
     * @return PublishPost
     */
    public function setPost(Post $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTargetSite()
    {
        return $this->targetSite;
    }

    /**
     * @param mixed $targetSite
     * @return PublishPost
     */
    public function setTargetSite($targetSite)
    {
        $this->targetSite = $targetSite;

        return $this;
    }

    /**
     * Get category
     *
     * @return PostCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set category
     *
     * @param PostCategory $category
     * @return PublishPost
     */
    public function setCategory(PostCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }
}
