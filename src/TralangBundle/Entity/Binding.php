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
     */
    private $id_user;

    /**
     * @ORM\Column(type="integer", length=255)
     */
    private $id_word;

    public function setId($id){
        $this->id = $id;
    }


    public function setIdUser($idUser){
        $this->id_user = $idUser;
    }

    public function setIdWords($idWords){
        $this->id_word = $idWords;
    }

    /**
     * Get id
     * @return integer
     */
    public function getId(){
        return $this->id;
    }

    /**
     * Get idUser
     * @return integer
     */
    public function getIdUser(){
        $this->id_user;
    }

    /**
     * Get idWords
     * @return integer
     */
    public function getIdWords(){
        $this->id_word;
    }
}
