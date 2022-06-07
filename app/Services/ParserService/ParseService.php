<?php


namespace App\Services\ParserService;


use DiDom\Document;

class ParseService implements Contracts\ParseServiceContract
{

    /**
     * @return mixed
     */
    public function callConnectToParse()
    {
        return new Document(config('services.parser.url'), true);
    }

    /**
     * @return mixed
     */
    public function parseHtml()
    {
        $html = $this->callConnectToParse();

        $products = $html->find('script');

        return $products;
    }
}



