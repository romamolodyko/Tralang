<?php

namespace TralangBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="binding")
 */
class Binding
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", length=255)
     * @Assets\NotBlank()
     */
    private $idUser;

    /**
     * @ORM\Column(type="integer", length=255)
     * @Assets\NotBlank()
     */
    private $idWord;

    public function setId($id){
        $this->id = $id;
    }


    public function setIdUser($idUser){
        $this->idUser = $idUser;
    }

    public function setIdWords($idWords){
        $this->idWord = $idWords;
    }
}
