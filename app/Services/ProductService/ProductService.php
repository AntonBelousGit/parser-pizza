<?php

declare(strict_types=1);

namespace App\Services\ProductService;


use App\Models\Product;
use App\Repositories\ProductRepositories;
use App\Services\ProductService\Contracts\ProductServiceContract;
use App\Services\ProductService\Contracts\ProductValidatorContract;
use Illuminate\Support\Arr;
use Throwable;

class ProductService implements ProductServiceContract
{

    protected array $sizes = [];

    /**
     * @param ProductValidatorContract $validatorContract
     * @param ProductRepositories $productRepositories
     */
    public function __construct(
        protected ProductValidatorContract $validatorContract,
        protected ProductRepositories $productRepositories,
    )
    {
    }

    /**
     * @param array $array
     * @return mixed
     */
    public function store(array $array = []): bool
    {
        try {

            foreach ($array as $item) {


                $item = $this->validatorContract->validate($item);


                $item['name'] = html_entity_decode($item['name']);

                try {
                    $product = (new Product())->create($item);

                    $product->topping()->attach(Arr::pluck($item['toppings'], 'id'));

                    foreach ($item['sizes'] as $size) {
                        foreach ($size['flavors'] as $flavor) {
//
                            $product->size()->attach($size['id'], ['flavor_id' => $flavor['id'], 'price' => $flavor['product']['price']]);
                        }
                    }

                } catch (Throwable $e) {

                    report($e);
                    continue;
                }
            }
        } catch (Throwable $e) {
            report($e);
            return false;
        }
        return true;
    }

    /**
     * @param array $array
     * @return bool
     */
    public function update(array $array = []): bool
    {
//        try {
//
//            foreach ($array as $size) {
//
//                $size = $this->validatorContract->validate($size);
//
//                $data = [
//                    'id' => $size['id'],
//                    'name' => html_entity_decode($size['name']),
//                ];
//
//                try {
//                    $update_size = $this->productRepositories->getProductByID($data['id']);
//                    if ($update_size) {
//                        $update_size->update($data);
////                        UpdateSizeAndSaveJob::dispatch($update_size,$data);
//                    } else {
//                        (new Product())->create($data);
////                        GetParseSizeAndSaveJob::dispatch($data);
//                    }
//
//                } catch (Throwable $e) {
//
//                    report($e);
//                    continue;
//                }
//            }
//        } catch (Throwable $e) {
//            report($e);
//            return false;
//        }
//        return true;
    }
}
