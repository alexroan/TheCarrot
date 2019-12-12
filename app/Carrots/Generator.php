<?php

namespace App\Carrots;

use App\Carrots\Utils\Formatter;
use App\Data\CarrotDataAccessor;
use App\Data\MailchimpDataAccessor;
use App\Data\ProductDataAccessor;
use Illuminate\Support\Facades\Log;

class Generator {

    private $mailchimpAccessor;
    private $productAccessor;
    private $carrotAccessor;
    private $formatter;

    public function __construct()
    {
        $this->mailchimpAccessor = app(MailchimpDataAccessor::class);
        $this->productAccessor = app(ProductDataAccessor::class);
        $this->carrotAccessor = app(CarrotDataAccessor::class);
        $this->formatter = app(Formatter::class);
    }

    /**
     * Create the scripts for the partner
     *
     * @param Object $carrot - Recrod from the database
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
        $carrotIdJavascript = "window.carrotId = '" . $carrot->id . "';";

        //got the image (selected_keyring)
        $imageJavascript = "const SELECTED_KEYRING = '" . $carrot->image . "';";

        // $baseFile = \public_path() . '/popups/carrots/generatedHeadScript.js';
        // $contents = file_get_contents($baseFile);

    }
}