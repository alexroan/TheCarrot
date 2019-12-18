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
        $discountJavascript = "window.discountCode = '" . $discountCodeRow->code . "';\n";

        //got title
        $titleJavascript = "const TITLE = '" . $carrot->title . "';\n";

        //got subtitle
        $subtitleJavascript = "const SUBTITLE = '" . $carrot->subtitle . "';\n";

        //got carrotId
        $carrotIdJavascript = "window.carrotId = '" . $carrot->id . "';\n";

        //got the image (selected_keyring)
        $imageJavascript = "const SELECTED_KEYRING = '" . $carrot->image . "';\n";

        //get base file
        $contents = $this->files->readBaseFile();

        //prepend data to beginning
        $contents = $titleJavascript
            . $subtitleJavascript
            . $mergeFieldJavascript
            . $imageJavascript
            . $productsJavascript
            . $carrotIdJavascript
            . $discountJavascript
            . $contents;

        $newFileName = $carrot->id . '.js';
        return $this->files->putNewFile($newFileName, $contents);
    }
}
