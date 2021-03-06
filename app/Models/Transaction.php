<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'transaction_date',
        'amount',
        'description',
    ];

    // protected $dates - specifies what column return as Carbon object.
    // So we can perform Carbon operations on it.
    protected $dates = ['transaction_date'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //Setter - Automatically set attribute value during store operation.
    // Should conform to naming convention: "set(name of attribute/column)Attribute" - setAmountAttribute.
    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = $value * 100;
    }

    public function setTransactionDateAttribute($value)
    {
        $this->attributes['transaction_date'] = Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
    }

}
