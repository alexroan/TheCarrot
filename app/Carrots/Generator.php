<?php

namespace App\Carrots;

use App\Carrots\Utils\Files;
use App\Carrots\Utils\Formatter;
use App\Data\CarrotDataAccessor;
use App\Data\MailchimpDataAccessor;
use App\Data\ProductDataAccessor;
use Illuminate\Support\Facades\Log;

class Generator
{
    private $mailchimpAccessor;
    private $productAccessor;
    private $carrotAccessor;
    private $formatter;
    private $files;

    public function __construct()
    {
        $this->mailchimpAccessor = app(MailchimpDataAccessor::class);
        $this->productAccessor = app(ProductDataAccessor::class);
        $this->carrotAccessor = app(CarrotDataAccessor::class);
        $this->formatter = app(Formatter::class);
        $this->files = app(Files::class);
    }


    public function generateCarrotHtml($carrot)
    {
        $html = $this->files->readHtmlTemplate();
        $product = $this->productAccessor->getProduct($carrot->product_id);

        //{{product-image}}
        $html = str_replace("{{product-image}}", $product->image, $html);

        //{{product-image-small}}
        $html = str_replace("{{product-image-small}}", $product->image . '-r', $html);

        //{{h1}}
        $html = str_replace("{{h1}}", $carrot->title, $html);

        //{{h2}}
        $html = str_replace("{{h2}}", $carrot->subtitle, $html);

        //{{subscribe-url}}
        $html = str_replace("{{subscribe-url}}", config('app.url') . '/subscribe', $html);

        //{{carrot-id}}
        $html = str_replace("{{carrot-id}}", $carrot->id, $html);

        //{{product-options}}
        $products = $this->productAccessor->getProducts();
        $productsHtml = '';
        foreach ($products as $prod) {
            $selected = ($prod->id == $carrot->product_id ? 'selected' : '');
            $option = '<option ' . $selected . ' data-image="' . $prod->image . '" value="'
                . $prod->product_id . '">' . $prod->name . '</option>';
            $productsHtml = $productsHtml . $option;
        }
        $html = str_replace("{{product-options}}", $productsHtml, $html);

        //{{merge-fields}}
        $mergeFields = $this->mailchimpAccessor->getMergeFields($carrot->mailchimp_list_id);
        $mergeFieldsHtml = '';
        foreach ($mergeFields as $field) {
            //if has choices, make select
            $fieldHtml = '<div class="form-group">';
            $id = "MERGE||" . $field->tag;
            if (count($field->choices) > 0) {
                $fieldHtml .= '<select required name="' . $id . '" id="' . $id
                    . '" form="signupcarrot-form" class="form-control">';
                $fieldHtml .= '<option selected disabled>' . $field->name . '</option>';
                foreach ($field->choices as $choice) {
                    $fieldHtml .= '<option value="' . $choice->value . '">' . $choice->value . '</option>';
                }
                $fieldHtml .= '</select>';
            } else {
                $fieldHtml .= '<input required class="form-control" type="text" name="' . $id
                    . '" id="' . $id . '" placeholder="' . $field->name . '">';
            }
            $fieldHtml .= '</div>';
            //TODO number, text, checkbox, etc - All mailchimp supported items
            $mergeFieldsHtml .= $fieldHtml;
        }
        $html = str_replace("{{merge-fields}}", $mergeFieldsHtml, $html);

        //{{button-style}}
        $buttonStyle = "background-color: " . $product->colour_code;
        $html = str_replace("{{button-style}}", $buttonStyle, $html);

        $filename = $carrot->id . '.html';
        return $this->files->putHtmlFile($filename, $html);
    }


    public function compileCarrotJs(int $carrotId, string $htmlFile)
    {
        $htmlContent = $this->files->readFile($htmlFile);
        $htmlContent = str_replace("\n", "\\\n", $htmlContent);
        $js = $this->files->readBaseFile();

        // Add variable containing html content
        $htmlJs = "var fileContent = '$htmlContent';";
        $js = $htmlJs . $js;

        // Add impression url
        $impressionUrl = config('app.url') . '/api/impression';
        $js = "var impressionUrl = '$impressionUrl';" . $js;

        $filename = $carrotId . '.js';
        return $this->files->putCompiledJsFile($filename, $js);
    }
}
