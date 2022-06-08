<?php

declare(strict_types=1);

namespace App\Services\SizeService;


use App\Models\Size;
use App\Services\SizeService\Contracts\SizeServiceContract;
use App\Services\SizeService\Contracts\SizeValidatorContract;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class SizeService implements SizeServiceContract
{

    protected array $sizes = [];

    /**
     * @param SizeValidatorContract $sizeDataValidator
     */
    public function __construct(
        protected SizeValidatorContract $sizeDataValidator
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

            foreach ($array as $size) {

                $size = $this->sizeDataValidator->validate($size);

                $data = [
                    'id' => $size['id'],
                    'name' => html_entity_decode($size['name']),
                ];

                try {

                    (new Size())->create($data);

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
     * @return mixed
     */
    public function update(array $array = [])
    {
        // TODO: Implement update() method.
    }
}
