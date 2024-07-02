<?php

declare(strict_types=1);

namespace DanielOzeh\Paga\Transporter\PagaBusiness;

use JustSteveKing\Transporter\Request;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\PendingRequest;

/**
 * 
 * @author danielozeh <https://github.com/danielozeh>
 * Paga base request to handle requests made to paga business api
 */
class BaseRequest extends Request {

    private static ?string $token = null;
    protected string $ref;

    public function __construct(HttpFactory $http) {
        parent::__construct($http);

        $this->baseUrl = env('PAGA_BUSINESS_BASE_URL');
        $this->withHeaders([
            'principal' => env('PAGA_BUSINESS_PRINCIPAL'),
            'credentials' => env('PAGA_BUSINESS_CREDENTIALS')
        ]);
    }

    protected function withRequest(PendingRequest $request): void {
        return;
    }

    public function setData(array $data) {
        $this->data = [
            'data' => json_encode($data)
        ];
    }

    protected function setRef(string $ref) {
        $this->ref = $ref;
    }

    public function withData(array $data): static {
        $this->data = array_merge($this->data, $data);

        $this->withHeaders([
            'hash' => hash('sha512', $this->data['referenceNumber'].env('PAGA_BUSINESS_API_KEY')),
        ]);

        return $this;
    }

}