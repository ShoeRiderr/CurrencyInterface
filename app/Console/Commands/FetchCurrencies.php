<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Currency;
use Illuminate\Support\Arr;

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

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $url = config('NBP.nbp_web_api_url');

        $responseA = Http::get(sprintf('%s/exchangerates/tables%s', $url, '/A/'))->json();
        $responseB = Http::get(sprintf('%s/exchangerates/tables%s', $url, '/B/'))->json();
        $responseC = Http::get(sprintf('%s/exchangerates/tables%s', $url, '/C/'))->json();

        $responses = collect($responseA)->concat($responseB)->concat($responseC);

        $rates = $responses->pluck('rates')->each(function ($rates) {
            collect($rates)->each(function ($rate) {
                if (Arr::has($rate, 'ask') || Arr::has($rate, 'bid')) {
                    $currency = Currency::where('code', Arr::get($rate, 'code'))->first();

                    $currency->update([
                        'bid' => Arr::get($rate, 'bid'),
                        'ask' => Arr::get($rate, 'ask'),
                    ]);
                } else {
                    Currency::updateOrCreate(
                        ['code' => Arr::get($rate, 'code')],
                        [
                            'currency' => Arr::get($rate, 'currency'),
                            'mid' => Arr::get($rate, 'mid'),
                        ]
                    );
                }
            });
        });
        
    }
}
