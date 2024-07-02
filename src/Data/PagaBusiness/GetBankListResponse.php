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
class GetBankListResponse extends Data {

    public function __construct(
        public int $responseCode,
        public string $referenceNumber,
        // public array $banks,
        #[MapInputName('banks')]
        #[DataCollectionOf(Bank::class)]
        public DataCollection $banks,
    ) {}
}

class Bank extends Data
{
    public function __construct(
        public string $name,
        #[MapInputName('uuid')]
        public string $id,
        #[MapInputName('interInstitutionCode')]
        public ?string $interInstitutionCode,
        #[MapInputName('sortCode')]
        public ?string $code
    ) {}
}
