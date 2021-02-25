<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
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


    // Getters and setters
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name
    }
}