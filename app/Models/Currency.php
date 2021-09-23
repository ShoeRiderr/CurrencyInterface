<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Currency extends Model
{
    use SoftDeletes;

    /**
     * @var array<string>
     */
    protected $fillable = [
        'currency',
        'code',
        'mid',
        'bid',
        'ask',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(Currency::class);
    }
}
