<?php

namespace DanielOzeh\Paga\Transporter\PagaBusiness;

use DanielOzeh\Paga\Transporter\PagaBusiness\BaseRequest;

/**
 * Validate deposit to bank from paga business
 * 
 * @author danielozeh <https://github.com/danielozeh>
 */
class ValidateDepositToBank extends BaseRequest {
    
    protected string $method = 'POST';
    protected string $path = '/paga-webservices/business-rest/secured/validateDepositToBank';

    public function PostData(string $referenceNumber, string $amount, string $bankId, string $accountNumber) : static {
        return $this->withData([
            'referenceNumber' => $referenceNumber,
            'amount' => $amount,
            'destinationBankUUID' => $bankId,
            'destinationBankAccountNumber' => $accountNumber
        ])->withHeaders([
            'hash' => hash('sha512', $referenceNumber.$amount.$bankId.$accountNumber.env('PAGA_BUSINESS_API_KEY')),
        ]);
    }
}

