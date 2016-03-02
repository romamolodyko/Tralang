<?php

namespace TralangBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */

class Users
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $email;

    /**
     * @ORM\Column(type="text")
     */
    private $password;

    /**
     * Set user name
     * @param name
     * @return Users
     */
    public function setName($name){
        $this->name = $name;
        return $this;
    }

    /**
     * Set user email
     * @param email
     * @return Users
     */
   public function setEmail($email){
        $this->email = $email;
        return $this;
    }

    /**
     * Set pass
     * @param password
     * @return string
     */
    public function setPassword($password){
        $this->password = $password;
        return $this;
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
     * Get user name
     *
     * @return string
     */
    public function getName(){
        return $this->name;
    }

    /**
     * Get user email
     *
     * @return string
     */
    public function getEmail(){
        return $this->email;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword(){
        return $this->password;
    }


}
