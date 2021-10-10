<?php declare(strict_types=1);

namespace App\Components\Task\Contracts;

use JsonSerializable;

class AddTaskResponse  implements JsonSerializable
{
    /** @var int  */
    private $id;

    public function __construct(int $id){
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function jsonSerialize()
    {
        return[
            "id" => $this->getId()
        ];
    }
}
