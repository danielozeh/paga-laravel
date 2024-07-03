<?php
namespace DanielOzeh\Paga\Data\PagaBusiness;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\DataCollection;

/**
 * Get bank list response from paga
 * 
 * @author danielozeh <https://github.com/danielozeh>
 */
class ValidateDepositToBankResponse extends Data {

    public function __construct(
        public int $responseCode,
        public string $referenceNumber,
        public ?string $message,
        public ?string $destinationAccountHolderNameAtBank,
        public ?string $fee,
        public ?string $vat,
    ) {}
}
