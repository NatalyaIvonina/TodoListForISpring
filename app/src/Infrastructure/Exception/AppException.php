<?php declare(strict_types=1);

namespace App\Infrastructure\Exception;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AppException extends HttpException
{
    /** @var AppExceptionContext|null */
    protected $context;

    public function __construct(
        AppExceptionContext $context = null,
        Exception $previous = null,
        ?string $message = 'Internal server error',
        int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR,
        int $errorCode = 0,
        array $headers = []
    ) {
        parent::__construct($statusCode, $message, $previous, $headers, $errorCode);
        $this->context = $context;
    }

    /**
     * @param bool $condition
     * @param AppExceptionContext|null $ctx
     *
     * @throws $this
     */
    public static function throwIf(bool $condition, AppExceptionContext $ctx = null): void
    {
        if ($condition) {
            throw new static($ctx);
        }
    }

    /**
     * @param bool $condition
     * @param AppExceptionContext|null $ctx
     *
     * @throws $this
     */
    public static function throwIfNot(bool $condition, AppExceptionContext $ctx = null): void
    {
        if (!$condition) {
            throw new static($ctx);
        }
    }

    /**
     * @param $obj
     * @param AppExceptionContext|null $ctx
     *
     * @throws $this
     */
    public static function throwIfNull($obj, AppExceptionContext $ctx = null): void
    {
        self::throwIf($obj === null, $ctx);
    }

    public static function wrap(Exception $e, ?AppExceptionContext $ctx = null): self
    {
        return new static($ctx, $e->getPrevious(), $e->getMessage());
    }

    public function getContext(): array
    {
        return $this->context ? $this->context->build() : [];
    }
}
