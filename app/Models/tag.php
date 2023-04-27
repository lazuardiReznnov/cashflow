<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

class tag extends Model
{
    protected $guarded = ['id'];

    public function cashflows(): MorphToMany
    {
        return $this->morphedByMany(Cashflow::class, 'taggable');
    }
}
