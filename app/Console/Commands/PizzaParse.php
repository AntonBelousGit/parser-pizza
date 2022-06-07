<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\ParserService\Contracts\ParseServiceContract;
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
    public function handle(ParseServiceContract $contract)
    {
        dd($contract->parseHtml());
    }
}
