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
     * @Assert\NotBlank(message = "Word doesn't add")
     */
    public function setRuWord($ruWord){
        $this->ru_words = $ruWord;
    }

    /**
     * @Assert\NotBlank(message = "Word doesn't add")
     */
    public function setEnWord($enWord){
        $this->en_words = $enWord;
    }

    /**
     * Get user id
     *
     * @return string
     */
    public function getId(){
        return $this->id;
    }

    /**
     * Get user enWord
     * @Assert\NotBlank(message = "Word doesn't exist")
     * @return string
     */
    public function getEnWord(){
        return $this->en_words;
    }

    /**
     * Get user id
     * @Assert\NotBlank(message = "Word doesn't exist")
     * @return string
     */
    public function getRuWord(){
        return $this->ru_words;
    }
}
