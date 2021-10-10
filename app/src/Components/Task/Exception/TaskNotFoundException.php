<?php declare(strict_types=1);

namespace App\Components\Task\Exception;

use App\Infrastructure\Exception\AppException;
use App\Infrastructure\Exception\AppExceptionContext;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class TaskNotFoundException extends AppException
{
    private const ERROR_CODE = 1;

    public function __construct(
        AppExceptionContext $context = null,
        Exception $previous = null,
        ?string $message = 'Not found',
        int $statusCode = Response::HTTP_NOT_FOUND,
        int $errorCode = self::ERROR_CODE,
        array $headers = []
    )
    {
        parent::__construct($context, $previous, $message, $statusCode, $errorCode, $headers);
    }
}
