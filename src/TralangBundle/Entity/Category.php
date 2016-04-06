<?php

namespace TralangBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="TralangBundle\Repository\CategoryRepository")
 */
class Category
{
    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=255, unique=true)
     * @ORM\OneToMany(targetEntity="TralangBundle\Entity\Words", mappedBy="category")
     */
    private $categories;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set category
     *
     * @return Category
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;

        return $this;
    }


    /**
     * Get category
     *
     * @return string
     */
    public function getCategories()
    {
        return $this->categories;
    }
}

