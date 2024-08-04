<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\ProductExtraField;
use App\Models\ProductImage;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Exception;

class ProductsImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    public function model(array $row)
    {
        if (!isset($row['naimenovanie']) || !isset($row['vnesnii_kod'])) {
            throw new Exception('Необходимые поля отсутствуют в строке: ' . json_encode($row));
        }

        // Преобразование значений с запятой в десятичные числа с точкой
        $price = $this->convertToDecimal($row['cena_cena_prodazi']);
        $discount = isset($row['minimaalnaia_tsena']) ? $this->convertToDecimal($row['minimaalnaia_tsena']) : null;

        $product = Product::create([
            'name' => $row['naimenovanie'],
            'external_code' => $row['vnesnii_kod'],
            'description' => $row['opisanie'] ?? null,
            'price' => $price,
            'discount' => $discount,
        ]);

        foreach ($row as $key => $value) {
            if (strpos($key, 'dop_pole_') === 0) {
                if ($value !== null && $value !== '') {
                    ProductExtraField::create([
                        'product_id' => $product->id,
                        'key' => $key,
                        'value' => $value,
                    ]);
                }
            }

            if (strpos($key, 'dop_pole_ssylki_na_foto') === 0) {
                if ($value !== null && $value !== '') {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'url' => $value,
                        'path' => $value,
                    ]);
                }
            }
        }
    }

    private function convertToDecimal($value)
    {
        $value = str_replace(' ', '', $value);
        return str_replace(',', '.', $value);
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}