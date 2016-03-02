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
        return $this->id_user;
    }

    /**
     * Get idWords
     * @return integer
     */
    public function getIdWords(){
        return $this->id_word;
    }

    /**
     * Set idWord
     *
     * @param integer $idWord
     *
     * @return Binding
     */
    public function setIdWord($idWord)
    {
        $this->id_word = $idWord;

        return $this;
    }

    /**
     * Get idWord
     *
     * @return integer
     */
    public function getIdWord()
    {
        return $this->id_word;
    }
}
