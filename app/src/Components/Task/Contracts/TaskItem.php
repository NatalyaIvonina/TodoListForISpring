<?php declare(strict_types=1);

namespace App\Components\Task\Contracts;

use App\Entity\Task;
use JsonSerializable;

class TaskItem implements JsonSerializable
{
    /** @var int */
    private $id;

    /** @var string */
    private $description;

    public function __construct(Task $task)
    {
        $this->id = $task->getId();
        $this->description = $task->getDescription();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function jsonSerialize()
    {
        return [
            "id" => $this->getId(),
            "description" => $this->getDescription()
        ];
    }
}
