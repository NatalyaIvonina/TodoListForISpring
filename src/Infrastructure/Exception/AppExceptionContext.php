<?php declare(strict_types=1);

namespace App\Infrastructure\Exception;

use Throwable;

class AppExceptionContext
{
    private $ctx = [];

    /**
     * @param null $caller
     * @return static
     */
    public static function create($caller = null): self
    {
        $it = new static();
        if ($caller) {
            $it->caller($caller);
        }

        return $it;
    }

    public function build(): array
    {
        return $this->ctx;
    }

    public function url(string $url): self
    {
        $this->ctx['url'] = $url;

        return $this;
    }

    public function merchantId(int $id): self
    {
        $this->ctx['merchant'] = $id;

        return $this;
    }

    public function programId(int $id): self
    {
        $this->ctx['program'] = $id;

        return $this;
    }

    public function projectId(int $id): self
    {
        $this->ctx['project'] = $id;

        return $this;
    }

    public function domainId(?int $id): self
    {
        $this->ctx['domain'] = $id;

        return $this;
    }

    public function invitationId(int $id): self
    {
        $this->ctx['invitation'] = $id;

        return $this;
    }

    public function caller($obj): self
    {
        $this->ctx['caller'] = get_class($obj);

        return $this;
    }

    public function steamAppId(int $id): self
    {
        $this->ctx['steamAppId'] = $id;

        return $this;
    }

    public function socialChannel(string $provider, $id): self
    {
        $this->ctx['provider'] = $provider;
        $this->ctx['socialId'] = $id;

        return $this;
    }

    public function userId(int $id): self
    {
        $this->ctx['user'] = $id;

        return $this;
    }

    public function networkId(int $id): self
    {
        $this->ctx['network'] = $id;

        return $this;
    }

    public function invoiceId(int $id): self
    {
        $this->ctx['invoice'] = $id;

        return $this;
    }

    public function dealId(int $id): self
    {
        $this->ctx['deal'] = $id;

        return $this;
    }

    public function sku(string $sku): self
    {
        $this->ctx['sku'] = $sku;

        return $this;
    }

    public function clickId(int $id): self
    {
        $this->ctx['click'] = $id;

        return $this;
    }

    public function stackTrace(Throwable $e): self
    {
        $this->append('err_msg', $e->getMessage());
        $this->append('stack', $e->getTraceAsString());

        return $this;
    }

    public function provider(string $name): self
    {
        $this->ctx['provider'] = $name;

        return $this;
    }

    public function value(string $name): self
    {
        $this->ctx['value'] = $name;

        return $this;
    }

    public function code(string $code): self
    {
        $this->ctx['code'] = $code;

        return $this;
    }

    public function email(string $email): self
    {
        $this->ctx['email'] = $email;

        return $this;
    }

    public function type(string $type): self
    {
        $this->ctx['type'] = $type;

        return $this;
    }

    public function payoutRequestId(int $requestId): self
    {
        return $this->append('payout_request_id', $requestId);
    }

    public function message(?string $value): self
    {
        return $this->append('message', $value);
    }

    public function datePayout(?string $value): self
    {
        return $this->append('date_payout', $value);
    }

    public function status(?string $value): self
    {
        return $this->append('status', $value);
    }

    protected function append(string $key, $value): self
    {
        $this->ctx[$key] = $value;

        return $this;
    }

    public function row(array $row): self
    {
        $this->ctx['row'] = $row;

        return $this;
    }

    public function host(string $host): self
    {
        $this->ctx['host'] = $host;

        return $this;
    }

    public function context(?array $context): self
    {
        if ($context === null) {
            return $this;
        }

        $this->ctx['context'] = $context;

        return $this;
    }
}
