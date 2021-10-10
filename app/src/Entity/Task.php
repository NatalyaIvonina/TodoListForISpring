<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 */
class Task
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     * @var bool
     */
    private $isCompleted = false;

    /**
     * @ORM\Column(type="boolean")
     * @var bool
     */
    private $isDeleted = false;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime")
     */
    private $dateUpdated;

    public function __construct(string $description)
    {
        $this->description = $description;
        $this->dateCreated = new DateTime();
        $this->dateUpdated = new DateTime();
    }

    /**
     * @return bool
     */
    public function isCompleted(): bool
    {
        return $this->isCompleted;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->isDeleted;
    }

    /**
     * @param bool $isDeleted
     */
    public function setIsDeleted(bool $isDeleted): void
    {
        $this->isDeleted = $isDeleted;
    }


    /**
     * @param bool $isCompleted
     */
    public function setIsCompleted(bool $isCompleted): void
    {
        $this->isCompleted = $isCompleted;
    }

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
    public function getDescription(): string
    {
        return $this->description;
    }
}