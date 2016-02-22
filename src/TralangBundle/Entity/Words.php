<?php

namespace TralangBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraint as Assert;

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
     */
    protected $ruWords;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $enWords;

    /**
     * @Assert\NotBlank()
     */
    public function setRuWords($ruWords){
        $this->ruWords = $ruWords;
    }

    /**
     * @Assert\NotBlank()
     */
    public function setEnWords($enWords){
        $this->ruWords = $enWords;
    }
}
