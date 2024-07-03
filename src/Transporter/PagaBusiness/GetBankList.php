<?php

namespace DanielOzeh\Paga\Transporter\PagaBusiness;

use DanielOzeh\Paga\Transporter\PagaBusiness\BaseRequest;

/**
 * Get bank list from paga business
 * 
 * @author danielozeh <https://github.com/danielozeh>
 */
class GetBankList extends BaseRequest {
    
    protected string $method = 'POST';
    protected string $path = '/paga-webservices/business-rest/secured/getBanks';

    public function PostData(string $referenceNumber) : static {
        return $this->withData([
            'referenceNumber' => $referenceNumber
        ])
        ->withHeaders([
            'hash' => hash('sha512', $referenceNumber.env('PAGA_BUSINESS_API_KEY')),
        ]);
    }
}

