<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * AnimalCategory
 *
 * @ORM\Table(name="zpb_animal_categories")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\AnimalCategoryRepository")
 */
class AnimalCategory
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
     * @ORM\Column(name="slug", type="string", length=150)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="ZPB\AdminBundle\Entity\Animal", mappedBy="category")
     */
    private $animals;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->animals = new ArrayCollection();
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
     * @return AnimalCategory
     */
    public function setName($name)
    {
        $this->name = $name;

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
     * Set slug
     *
     * @param string $slug
     * @return AnimalCategory
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Add animals
     *
     * @param Animal $animals
     * @return AnimalCategory
     */
    public function addAnimal(Animal $animals)
    {
        $this->animals[] = $animals;

        return $this;
    }

    /**
     * Remove animals
     *
     * @param Animal $animals
     */
    public function removeAnimal(Animal $animals)
    {
        $this->animals->removeElement($animals);
    }

    /**
     * Get animals
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnimals()
    {
        return $this->animals;
    }
}
