<?php

declare(strict_types=1);

namespace App\Services\ParserService\Contracts;


use DiDom\Document;

interface ParseServiceContract
{

    public function callConnectToParse() : Document;

    public function parseHtml(): array;

}
