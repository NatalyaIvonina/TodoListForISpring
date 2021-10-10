<?php declare(strict_types=1);

namespace App\Components\Task\Contracts;

use App\Infrastructure\Http\RequestDTOInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateTaskRequest implements RequestDTOInterface
{
    /**
     * @Assert\Type("boolean")
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @var bool
     */
    private $isCompleted;

    public function __construct(Request $request)
    {
        $this->isCompleted = $request->get('isCompleted');
    }

    public function isCompleted(): bool
    {
        return $this->isCompleted;
    }

    public function setIsCompleted(bool $isCompleted): void
    {
        $this->isCompleted = $isCompleted;
    }
}
