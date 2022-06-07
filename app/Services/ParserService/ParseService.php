<?php

declare(strict_types=1);

namespace App\Services\ParserService;


use DiDom\Document;
use DiDom\Exceptions\InvalidSelectorException;

class ParseService implements Contracts\ParseServiceContract
{

    /**
     * @return Document
     */
    public function callConnectToParse(): Document
    {
        return new Document(config('services.parser.url'), true);
    }

    /**
     * @return array
     * @throws InvalidSelectorException
     */
    public function parseHtml(): array
    {
        $html = $this->callConnectToParse();

        $stringRawHtml = $html->find('script');

        $stringHtml = $stringRawHtml[8]->text();
        $array = explode("'", ($stringHtml));

        $str = preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
            return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
        }, $array[1]);

        $new = json_decode($str, true, 100);

        $product_collection = collect($new['data']['groups'])->pluck('products')->toArray();

        $products = call_user_func_array('array_merge', $product_collection);

        return $products;
    }
}



