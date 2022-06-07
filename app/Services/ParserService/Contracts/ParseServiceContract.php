<?php

declare(strict_types=1);

namespace App\Services\ParserService\Contracts;


interface ParseServiceContract
{

    public function callConnectToParse();

    public function parseHtml();

}
