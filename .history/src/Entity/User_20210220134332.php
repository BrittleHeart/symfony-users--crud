<?php

namespace App\Entity;

use Doctrine\ORM\Mapp

class User {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="timestamp")
     */
    private $created_at;

    /**
     * @ORM\Column(type="timestamp")
     */
    private $updated_at;
}