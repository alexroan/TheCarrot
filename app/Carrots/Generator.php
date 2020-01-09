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

        //{{h1}}
        $html = str_replace("{{h1}}", $carrot->title, $html);

        //{{h2}}
        $html = str_replace("{{h2}}", $carrot->subtitle, $html);

        //{{product-options}}
        $products = $this->productAccessor->getProducts();
        $productsHtml = '';
        foreach ($products as $product) {
            $selected = ($product->id == $carrot->product_id ? 'selected' : '');
            $option = '<option ' . $selected . ' data-image="' . $product->image . '" value="' . $product->product_id . '">' . $product->name . '</option>\n';
            $productsHtml = $productsHtml . $option;
        }
        $html = str_replace("{{product-options}}", $productsHtml, $html);

        //{{merge-fields}}
        $mergeFields = $this->mailchimpAccessor->getMergeFields($carrot->mailchimp_list_id);
        $mergeFieldsHtml = '';
        foreach ($mergeFields as $field) {
            //if has choices, make select
            $fieldHtml = '<div class="form-group">\n';
            $id = "MERGE||" . $field->tag;
            if (count($field->choices) > 0) {
                $fieldHtml .= '<select required name="' . $id . '" id="' . $id . '" class="form-control">\n';
                    $fieldHtml .= '<option selected disabled>' . $field->name . '</option>\n';
                    foreach ($field->choices as $choice) {
                        $fieldHtml .= '<option value="' . $choice->value . '">' . $choice->value . '</option>\n';
                    }
                $fieldHtml .= '</select>\n';
            }
            //if else text box
            else {
                $fieldHtml .= '<input required class="form-control" type="text" name="' . $id . '" id="' . $id . '" placeholder="' . $field->name . '">\n';
            }
            $fieldHtml .= '</div>\n';
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

        $htmlJs = "var fileContent = '$htmlContent';";
        $js = $htmlJs . $js;
        $filename = $carrotId . '.js';
        return $this->files->putCompiledJsFile($filename, $js);
    }
}
