<?php

namespace TralangBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="TralangBundle\Entity\BindingRepository")
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
    /**
     * @ORM\Column(type="integer", length=255)
     */
    private $TWState;

    /**
     * @ORM\Column(type="integer", length=255)
     */
    private $WTState;
    /**
     * @ORM\Column(type="integer", length=255)
     */
    private $LWState;

    public function setId($id){
        $this->id = $id;
    }


    public function setIdUser($idUser){
        $this->id_user = $idUser;
    }

    public function setIdWords($idWords){
        $this->id_word = $idWords;
    }

    public function setTWStateWord($state){
        $this->TWState = $state;
    }

    public function setWTStateWord($state){
        $this->WTState = $state;
    }

    public function setLWState($state){
        $this->LWState = $state;
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
        return $this->id_user;
    }

    /**
     * Get idWords
     * @return integer
     */
    public function getIdWords(){
        return $this->id_word;
    }

    public function getTWStateWord(){
        return $this->TWState;
    }

    public function getWTStateWord(){
        return $this->WTState;
    }

    public function getLWState(){
        return $this->LWState;
    }
}
