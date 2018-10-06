<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Serializable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 *
 * @UniqueEntity(fields="email", message="This email is already taken")
 * @UniqueEntity(fields="username", message="This username is already taken")
 */
class User implements UserInterface, Serializable {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=16, unique=true)
     * @Assert\Regex(
     *     pattern="/^([a-zA-Z0-9]{3,16})$/",
     *     message="Username should contain only alphanumeric characters and should be 3 to 16 characters long"
     * )
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     * @Assert\Length(
     *      max = 64,
     *      maxMessage = "Description cannot be longer than {{ limit }} characters"
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $avatar;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @Assert\Length(max="4096")
     * @Assert\Regex(
     *      pattern="/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/",
     *      message="Password should contain at least 8 characters, one big letter and one number"
     * )
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=32, unique=true)
     * @Assert\Email()
     * @Assert\Length(
     *      min = 6,
     *      max = 32,
     *      minMessage = "Email must be at least {{ limit }} characters long",
     *      maxMessage = "Email cannot be longer than {{ limit }} characters"
     * )
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="Snippet", mappedBy="author", fetch="LAZY")
     */
    private $snippets;

    /**
     * @ORM\Column(type="json_array")
     */
    private $roles;

    public function __construct() {
        $this->snippets = new ArrayCollection();
        $this->avatar = 'blank.png';
        $this->roles = array(
            'ROLE_USER'
        );
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getSnippets()
    {
        return $this->snippets;
    }

    /**
     * @param mixed $snippets
     */
    public function setSnippets($snippets)
    {
        $this->snippets = $snippets;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }


    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setRoles($roles) {
        $this->roles = $roles;
    }

    public function getRoles() {
        return $this->roles;
    }

    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->username,
            $this->password
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->username,
            $this->password
            ) = unserialize($serialized);
    }

    public function getSalt()
    {
    }
}