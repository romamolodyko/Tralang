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
    private $idUser;

    /**
     * @ORM\Column(type="integer", length=255)
     */
    private $idWord;

    /**
     * @ORM\Column(type="integer", length=255)
     */
    private $state;
}
