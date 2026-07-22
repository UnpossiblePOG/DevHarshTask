<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockTransaction extends Model
{
    protected $fillable = ['material_id', 'transaction_date', 'quantity'];

    public function material(): BelongsTo
    {
        // Links each transaction back to its associated material model.
        // Gives direct access to material attributes like name and category.
        return $this->belongsTo(Material::class);
    }
}