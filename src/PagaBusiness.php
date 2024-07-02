<?php
namespace DanielOzeh\Paga;

use App\Exceptions\FalseStatusException;
use DanielOzeh\Paga\Library\Traits\ApiResponseTrait;
use DanielOzeh\Paga\Data\PagaBusiness\GetBankListResponse;
use DanielOzeh\Paga\Transporter\PagaBusiness\GetBankList;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Str;

class PagaBusiness {

    use ApiResponseTrait;

    /**
     * @author Daniel Ozeh <https://github.com/danielozeh>
     * @throws RequestException
     */
    private static function processResponse($response, $module) {
        self::checkForFailure($response, $module);
        $response = $response->json();

        // \Log::debug("Paga", ["response"=> $response]);

        if (array_key_exists('responseCode', $response) && $response['responseCode'] == 0) {
            return $response;
            
        }
        \Log::error("$module --- response status is false");
        throw new \Exception($response);
    }

    private static function generateReference(): string
    {
        return 'PG-' . Str::random(26);
    }
    
    /**
     * @author Daniel Ozeh <https://github.com/danielozeh>
     * @return 
     */
    public static function getBankList() {
        $referenceNumber = self::generateReference();
        $response = GetBankList::build()
            ->PostData($referenceNumber)
            ->send();
        
        $response = self::processResponse($response, 'PagaBusiness::GetBankList');
        $response = GetBankListResponse::from($response);

        if ($response && $response->responseCode != 0) {
            return self::failureResponse('No data found');
        }
        return self::successResponse('List of banks returned successfully', $response);
    }
}

