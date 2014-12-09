<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Species
 *
 * @ORM\Table(name="zpb_species")
 * @ORM\Entity(repositoryClass="ZPB\AdminBundle\Entity\SpeciesRepository")
 * @UniqueEntity("name")
 */
class Species
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
     * @Assert\NotBlank()
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç',;.)(: -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="area", type="text")
     */
    private $area;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç',;.)(: -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="habitat", type="text")
     */
    private $habitat;
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç',;.)(: -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="diet", type="text")
     */
    private $diet;
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç',;.)(: -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="size", type="string", length=255)
     */
    private $size;
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç',;.)(: -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="weight", type="string", length=255)
     */
    private $weight;
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç',;.)(: -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="lifespan", type="string", length=255)
     */
    private $lifespan;
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç',;.)(: -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="gestation", type="string", nullable=false)
     */
    private $gestation;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="status_iucn", type="string", length=255, nullable=false)
     */
    private $statusIUCN;
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç' -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="genus", type="string", length=255, nullable=false)
     */
    private $genus;
    /**
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç' -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="classe", type="string", length=255, nullable=false)
     */
    private $classe;
    /**
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç' -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="family", type="string", length=255, nullable=false)
     */
    private $family;
    /**
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç' -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="animal_order", type="string", length=255, nullable=false)
     */
    private $animalOrder;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="long_description", type="text", nullable=false)
     */
    private $longDescription;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="ZPB\AdminBundle\Entity\Animal", mappedBy="species")
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
     * @return Species
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
     * @return Species
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get area
     *
     * @return string
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set area
     *
     * @param string $area
     * @return Species
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAnimalOrder()
    {
        return $this->animalOrder;
    }

    /**
     * @param mixed $animalOrder
     * @return Species
     */
    public function setAnimalOrder($animalOrder)
    {
        $this->animalOrder = $animalOrder;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * @param mixed $classe
     * @return Species
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return Species
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDiet()
    {
        return $this->diet;
    }

    /**
     * @param string $diet
     * @return Species
     */
    public function setDiet($diet)
    {
        $this->diet = $diet;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFamily()
    {
        return $this->family;
    }

    /**
     * @param mixed $family
     * @return Species
     */
    public function setFamily($family)
    {
        $this->family = $family;

        return $this;
    }

    /**
     * @return string
     */
    public function getGenus()
    {
        return $this->genus;
    }

    /**
     * @param string $genus
     * @return Species
     */
    public function setGenus($genus)
    {
        $this->genus = $genus;

        return $this;
    }

    /**
     * @return string
     */
    public function getGestation()
    {
        return $this->gestation;
    }

    /**
     * @param string $gestation
     * @return Species
     */
    public function setGestation($gestation)
    {
        $this->gestation = $gestation;

        return $this;
    }

    /**
     * @return string
     */
    public function getHabitat()
    {
        return $this->habitat;
    }

    /**
     * @param string $habitat
     * @return Species
     */
    public function setHabitat($habitat)
    {
        $this->habitat = $habitat;

        return $this;
    }

    /**
     * @return string
     */
    public function getLifespan()
    {
        return $this->lifespan;
    }

    /**
     * @param string $lifespan
     * @return Species
     */
    public function setLifespan($lifespan)
    {
        $this->lifespan = $lifespan;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLongDescription()
    {
        return $this->longDescription;
    }

    /**
     * @param mixed $longDescription
     * @return Species
     */
    public function setLongDescription($longDescription)
    {
        $this->longDescription = $longDescription;

        return $this;
    }

    /**
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param string $size
     * @return Species
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatusIUCN()
    {
        return $this->statusIUCN;
    }

    /**
     * @param mixed $statusIUCN
     * @return Species
     */
    public function setStatusIUCN($statusIUCN)
    {
        $this->statusIUCN = $statusIUCN;

        return $this;
    }

    /**
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param string $weight
     * @return Species
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Add animals
     *
     * @param Animal $animals
     * @return Species
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
