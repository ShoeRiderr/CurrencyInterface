<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Currency;
use App\Services\CurrencyService;

class FetchCurrencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currencies:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch all currencies from NBP API';

    private CurrencyService $currencyService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CurrencyService $currencyService)
    {
        parent::__construct();

        $this->currencyService = $currencyService;
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $responseA = $this->currencyService->setData('exchangerates/tables/A/')->toJson();
        $responseB = $this->currencyService->setData('exchangerates/tables/B/')->toJson();
        $responseC = $this->currencyService->setData('exchangerates/tables/C/')->toJson();

        $responses = collect($responseA)->concat($responseB)->concat($responseC);

        $rates = $responses->pluck('rates')->each(function ($rates) {
            collect($rates)->each(function ($rate) {
                $rate = collect($rate)->filter(function ($item) {
                    return !is_null($item);
                });

                Currency::updateOrCreate(
                    ['code' => $rate->pull('code')],
                    $rate->toArray()
                );
            });
        });
    }
}
