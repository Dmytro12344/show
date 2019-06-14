<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements UserInterface
{

    /**
     *@ORM\Column(type="integer")
     *@ORM\Id
     *@ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *@ORM\Column(type="string", length=255, unique=true)
     */
    private $username;

    /**
     *@ORM\Column(type="string", length=255)
     */
    private $password;

    private $plainPassword;

    /**
     *@ORM\Column(type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="array")
     */
    private $roles;

    public function __construct()
    {
        $this->roles = ['ROLE_USER'];
    }


    public function getRoles()
    {
        return (array)$this->roles;
    }


    public function getId()
    {
        return $this->id;
    }


    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }


    public function getUsername()
    {
        return $this->username;
    }


    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }


    public function getPassword()
    {
        return $this->password;
    }


    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }


    public function getEmail()
    {
        return $this->email;
    }

    public function getSalt()
    {

    }

    public function eraseCredentials()
    {

    }


    public function setId($id): void
    {
        $this->id = $id;
    }


    public function getPlainPassword()
    {
        return $this->plainPassword;
    }


    public function setPlainPassword($plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }
}
