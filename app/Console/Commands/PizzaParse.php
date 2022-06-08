<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Jobs\GetParseSizeAndSaveJob;
use App\Services\FlavorService\Contracts\FlavorServiceContract;
use App\Services\ParserService\Contracts\ParseServiceAttributeContract;
use App\Services\ParserService\Contracts\ParseServiceContract;
use App\Services\SizeService\Contracts\SizeServiceContract;
use App\Services\ToppingService\Contracts\ToppingServiceContract;
use App\Services\ToppingService\ToppingServiceProvider;
use Illuminate\Console\Command;

class PizzaParse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pizza:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to start parsing product';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(
        ParseServiceContract $contract,
        ParseServiceAttributeContract $attributeContract,
        SizeServiceContract $sizeServiceContract,
        FlavorServiceContract $flavorServiceContract,
        ToppingServiceContract $toppingServiceContract
    )
    {
        $attribute = $attributeContract->parseAttribute($contract->parseProduct());
//        $sizes = $sizeServiceContract->store($attribute[config('services.parser.product_attribute')]);
//        $flavors = $flavorServiceContract->store($attribute[config('services.parser.product_relations_attribute')]);
        $topping = $toppingServiceContract->store($attribute[config('services.parser.product_topping')]);
        dd($topping);
    }
}
