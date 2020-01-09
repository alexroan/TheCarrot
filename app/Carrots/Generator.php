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
            //TODO
        }
        $html = str_replace("{{product-options}}", $productsHtml, $html);
        //{{merge-fields}}
        $mergeFields = $this->mailchimpAccessor->getMergeFields($carrot->mailchimp_list_id);
        $mergeFieldsHtml = '';
        foreach ($mergeFields as $field) {
            //TODO
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

    /**
     * Create the scripts for the partner
     *
     * @param  Object $carrot - Recrod from the database
     * @return string path to new file
     */
    public function generate($carrot)
    {
        //get merge fields
        $mergeFields = $this->mailchimpAccessor->getMergeFields($carrot->mailchimp_list_id);
        $formattedMergeFields = $this->formatter->formatMergeFields($mergeFields);
        $mergeFieldJavascript = "const MERGE_FIELDS = " . $formattedMergeFields . ";\n";

        //get products
        $products = $this->productAccessor->getProducts();
        $formattedProducts = $this->formatter->formatProducts($products);
        $productsJavascript = "const PRODUCTS = " . $formattedProducts . ";\n";

        //get discount code
        $discountCodeRow = $this->carrotAccessor->getDiscountCode($carrot->id);
        $discountJavascript = "window.discountCode = \"" . $discountCodeRow->code . "\";\n";

        //got title
        $titleJavascript = "const TITLE = \"" . $carrot->title . "\";\n";

        //got subtitle
        $subtitleJavascript = "const SUBTITLE = \"" . $carrot->subtitle . "\";\n";

        //got carrotId
        $carrotIdJavascript = "window.carrotId = \"" . $carrot->id . "\";\n";

        //get the index of the product selected
        $keyringIndexJavascript = "const SELECTED_KEYRING_ID = " . $carrot->product_id . ";\n";
        $urls = "const ROOT_URL = '" . config('app.url') . "';
            window.impressionUrl = ROOT_URL + '/api/impression';
            window.subscribeUrl = ROOT_URL + '/subscribe';\n";

        //get base file
        $contents = $this->files->readBaseFile();

        //prepend data to beginning
        $contents = $titleJavascript
            . $subtitleJavascript
            . $mergeFieldJavascript
            . $keyringIndexJavascript
            . $productsJavascript
            . $carrotIdJavascript
            . $discountJavascript
            . $urls
            . $contents;

        $newFileName = $carrot->id . '.js';
        return $this->files->putNewFile($newFileName, $contents);
    }
}
