<?php declare(strict_types=1);

namespace App\Components\Task\Contracts;

use App\Infrastructure\Http\RequestDTOInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class AddTaskRequest implements RequestDTOInterface
{
    /**
     * @Assert\Type("string")
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Length(max = 1000)
     * @var string
     */
    private $description;

    public function __construct(Request $request)
    {
        $this->description = $request->get('description');
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
