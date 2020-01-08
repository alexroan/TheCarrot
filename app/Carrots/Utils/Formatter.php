<?php

namespace App\Carrots\Utils;

use Illuminate\Support\Facades\Log;

class Formatter
{

    /**
     * Format carrot to usable url
     *
     * @param  string $filepath
     * @return string $filepath
     */
    public function formatUrl(string $filepath)
    {
        $filepath = strstr($filepath, "/popups/carrots/generated/");
        $filepath = config('app.url') . $filepath;
        return $filepath;
    }

    /**
     * Format database rows for merge fields into
     * string which can be inserted into javascript
     *
     * @param  object $mergeFields
     * @return string
     */
    public function formatMergeFields(object $mergeFields)
    {
        $fields = [];
        foreach ($mergeFields as $field) {
            $newField = (object)[
                'placeholder' => $field->name,
                'tag' => $field->tag,
                'type' => $field->type
            ];

            if (count($field->choices) > 0) {
                $choices = [];
                foreach ($field->choices as $choice) {
                    $choices[] = $choice->value;
                }
                $newField->choices = $choices;
            }

            $fields[] = $newField;
        }
        return json_encode($fields);
    }

    /**
     * Format database rows for products into string
     * which can be inserted into javascript
     *
     * @param  object $products
     * @return string
     */
    public function formatProducts(object $products)
    {
        $productList = [];
        foreach ($products as $product) {
            $newProduct = (object)[
                'name' => $product->name,
                'value' => $product->product_id,
                'image' => $product->image,
                'colour' => $product->colour_code,
                'id' => $product->id
            ];

            $productList[] = $newProduct;
        }
        return json_encode($productList);
    }

    /**
     * Get product image from the products and the selected ID
     *
     * @param object $products
     * @param integer $productId
     * @return mixed string or boolean
     */
    public function getProductUsingId(object $products, int $productId)
    {
        foreach ($products as $product) {
            if ($product->id == $productId) {
                return $product;
            }
        }
        return false;
    }
}
