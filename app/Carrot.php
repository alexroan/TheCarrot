<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrot extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mailchimp_list_id',
        'google_font_id',
        'title',
        'subtitle',
        'product_id',
        'html_file',
        'carrot_file',
        'archived'
    ];

    public function discountCode()
    {
        return $this->hasOne(DiscountCode::class);
    }

    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function blacklist()
    {
        return $this->hasMany(BlacklistUrl::class);
    }

    public function font()
    {
        return $this->belongsTo(GoogleFont::class, 'google_font_id');
    }
}
