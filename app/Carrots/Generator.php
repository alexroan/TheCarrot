<?php

namespace App\Carrots;

use App\Carrots\Utils\Files;
use App\Carrots\Utils\Formatter;
use App\Data\CarrotDataAccessor;
use App\Data\MailchimpDataAccessor;
use App\Data\ProductDataAccessor;
use Illuminate\Support\Facades\App;
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

    /**
     * Generate HTML file for carrot
     *
     * @param object $carrot
     * @return mixed filepath or boolean
     */
    public function generateCarrotHtml($carrot)
    {
        $html = $this->files->readHtmlTemplate();
        $product = $this->productAccessor->getProduct($carrot->product_id);

        //{{font-family}}
        $html = str_replace("{{font-family}}", $carrot->font->family, $html);
        //{{font-category}}
        $html = str_replace("{{font-category}}", $carrot->font->category, $html);

        //{{app-url}}
        $html = str_replace("{{app-url}}", config('app.url'), $html);

        //{{product-image}}
        $html = str_replace("{{product-image}}", $product->image, $html);

        //{{product-id}}
        $html = str_replace("{{product-id}}", $product->product_id, $html);

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

        //{{merge-fields}}
        $mergeFields = $this->mailchimpAccessor->getMergeFields($carrot->mailchimp_list_id);
        $mergeFieldsHtml = '';
        foreach ($mergeFields as $field) {
            //if has choices, make select
            $fieldHtml = '<div class="form-group">';
            $id = "MERGE||" . $field->tag;
            if (count($field->choices) > 0) {
                $fieldHtml .= '<select required name="' . $id . '" id="' . $id
                    . '" form="signupcarrot-form" class="form-control form-control-sm">';
                $fieldHtml .= '<option selected="selected" disabled="disabled" value="">' . $field->name . '</option>';
                foreach ($field->choices as $choice) {
                    $fieldHtml .= '<option value="' . $choice->value . '">' . $choice->value . '</option>';
                }
                $fieldHtml .= '</select>';
            } else {
                $fieldHtml .= '<input required="true" class="form-control form-control-sm" type="text" name="' . $id
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

    /**
     * Compile a html file into referencable JS
     *
     * @param integer $carrotId
     * @param string $htmlFile
     * @return mixed filepath or boolean
     */
    public function compileCarrotJs(int $carrotId, string $htmlFile)
    {
        $htmlContent = $this->files->readFile($htmlFile);
        $htmlContent = str_replace("\n", "\\\n", $htmlContent);
        $js = $this->files->readJsTemplate();

        // Add variable containing html content
        $htmlJs = "var fileContent = '$htmlContent';";
        $js = $htmlJs . $js;

        // Add impression url
        $impressionUrl = config('app.url') . '/api/impression';
        $js = "var impressionUrl = '$impressionUrl';" . $js;

        // Add app url
        $appUrl = config('app.url');
        $js = "var appUrl = '$appUrl';" . $js;

        // Add display frequency
        $frequency = 'session';
        if (App::environment('local')) {
            $frequency = 'always';
        }
        $js = "var displayFrequency = '$frequency';" . $js;

        $env = config('app.env');
        $js = "var cookieId = 'signupcarrot_" . $env . "_$carrotId';" . $js;

        $carrot = $this->carrotAccessor->getCarrot($carrotId);
        $blacklistString = "var blacklist = [";
        foreach ($carrot->blacklist as $blacklistItem) {
            $blacklistString .= "'$blacklistItem->url',";
        }
        $blacklistString .= "];";
        $js = $blacklistString . $js;

        $filename = $carrotId . '.js';
        return $this->files->putCompiledJsFile($filename, $js);
    }
}
