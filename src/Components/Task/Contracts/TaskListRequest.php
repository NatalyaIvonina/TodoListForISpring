<?php declare(strict_types=1);

namespace App\Components\Task\Contracts;

use App\Infrastructure\Http\RequestDTOInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class TaskListRequest implements RequestDTOInterface
{
    private const DEFAULT_LIMIT = 20;
    private const DEFAULT_OFFSET = 0;

    /**
     * @Assert\Type("bool")
     * @Assert\NotNull()
     * @var boolean
     */
    private $isCompleted;

    /**
     * @Assert\Type("integer")
     * @Assert\Range(min = 0, max = 100)
     * @var int
     */
    private $limit = self::DEFAULT_LIMIT;

    /**
     * @Assert\Type("integer")
     * @Assert\GreaterThanOrEqual(0)
     * @var int
     */
    private $offset;

    public function __construct(Request $req)
    {
        $this->isCompleted = filter_var($req->query->get('isCompleted'), FILTER_VALIDATE_BOOLEAN);
        $this->limit = (int)$req->query->get('limit') ?: self::DEFAULT_LIMIT;
        $this->offset = (int)$req->query->get('offset') ?: self::DEFAULT_OFFSET;
    }

    public function isCompleted(): bool
    {
        return $this->isCompleted;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }
}