<?php

namespace Jimm\BookBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Books
 * @ORM\Table(name="books")
 * @ORM\Entity(repositoryClass="Jimm\BookBundle\Repository\BookRepository")
 */
class Book
{

    public function __construct()
    {
        $this->authors = new ArrayCollection();
        $this->updateTimestamps();
        $this->setMarking('available');
    }

    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     * @Assert\Length(max="100")
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="authors", type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     * @Assert\Length(max="100")
     */
    private $authors;

    /**
     * @var \DateTime
     * @ORM\Column(name="publish_at", type="date", nullable=true)
     * @Assert\NotBlank()
     * @Assert\Date()
     */
    private $publishedAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * @ORM\Column(name="marking", type="string", nullable=true)
     */
    private $marking;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     *
     * @return Book
     */
    public function setName($name): Book
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * @param string|null $authors
     *
     * @return Book
     */
    public function setAuthors($authors): Book
    {
        $this->authors = $authors;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @param \DateTime|null $publishedAt
     *
     * @return Book
     */
    public function setPublishedAt($publishedAt): Book
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return Book
     */
    public function setCreatedAt(\DateTime $createdAt): Book
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     *
     * @return Book
     */
    public function setUpdatedAt(\DateTime $updatedAt): Book
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getMarking()
    {
        return $this->marking;
    }

    /**
     * @param string|null $marking
     *
     * @return Book
     */
    public function setMarking($marking): Book
    {
        $this->marking = $marking;

        return $this;
    }

    public function updateTimestamps()
    {
        $dateTime = new \DateTime(date('Y-m-d H:i:s'));
        if (null === $this->createdAt) {
            $this->createdAt = $dateTime;
        }
        $this->updatedAt = $dateTime;
    }

}