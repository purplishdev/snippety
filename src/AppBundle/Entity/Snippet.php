<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="snippets")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SnippetRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Snippet implements \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Length(
     *      max = 64,
     *      maxMessage = "Title cannot be longer than {{ limit }} characters"
     * )
     * @Assert\Regex(
     *     pattern="/^([a-zA-Z0-9]+)$/",
     *     message="Title must contain only alphanumeric characters"
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Length(
     *      max = 64,
     *      maxMessage = "Description cannot be longer than {{ limit }} characters"
     * )
     */
    private $description;

    /**
     * @Assert\NotNull()
     * @ORM\ManyToOne(targetEntity="User", inversedBy="snippets", fetch="LAZY")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id", nullable=false)
     */
    private $author;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Choice(callback = {"AppBundle\Languages", "getArray"})
     */
    private $language;

    /**
     * @ORM\Column(type="boolean")
     */
    private $private;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="text")
     */
    private $code;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createDate;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return mixed
     */
    public function isPrivate()
    {
        return $this->private;
    }

    /**
     * @param mixed $private
     */
    public function setPrivate($private)
    {
        $this->private = $private;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * @param \DateTime $createDate
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
    }

    public function serialize()
    {
        // TODO: Implement serialize() method.
    }

    public function unserialize($serialized)
    {
        // TODO: Implement unserialize() method.
    }

    /**
     * @ORM\PrePersist
     */
    public function updatedTimestamps()
    {
        $this->setCreateDate(new \DateTime('now'));
    }
}