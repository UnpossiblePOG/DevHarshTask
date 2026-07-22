<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    use SoftDeletes;

    protected $fillable = ['category_id', 'name', 'opening_balance'];

    public function category(): BelongsTo
    {
        //BelongsTo is used for accessing parent data using Eloquent syntax
        //unlike hasMany which is for accessing child data
        return $this->belongsTo(Category::class);
    }

    public function transactions(): HasMany
    {
        // Defines a one-to-many relationship linking this material to its stock transactions.
        // Allows retrieving all inward and outward log entries for this item.
        return $this->hasMany(StockTransaction::class);
    }

    // Accessor to dynamically calculate Current Balance
    public function getCurrentBalanceAttribute(): float
    {
        // Calculates current stock balance on the fly by adding opening balance and sum of transaction quantities.
        // Positive quantities add stock while negative quantities reduce stock.
        return $this->opening_balance + $this->transactions()->sum('quantity');
    }
}