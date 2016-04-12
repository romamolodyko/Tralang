<?php

namespace TralangBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="words")
 */
class Words
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $ru_words;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $en_words;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="")
     */
    protected $category;


    /**
     * Get user id
     *
     * @return string
     */
    public function getId(){
        return $this->id;
    }


    /**
     * Set ruWords
     *
     * @param string $ruWords
     *
     * @return Words
     */
   public function setRuWords($ruWords)
    {
        $this->ru_words = $ruWords;

        return $this;
    }

    /**
     * Get ruWords
     *
     * @return string
     */
    public function getRuWords()
    {
        return $this->ru_words;
    }

    /**
     * Set enWords
     *
     * @param string $enWords
     *
     * @return Words
     */
    public function setEnWords($enWords)
    {
        $this->en_words = $enWords;

        return $this;
    }

    /**
     * Get enWords
     *
     * @return string
     */
    public function getEnWords()
    {
        return $this->en_words;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return Words
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }
}
