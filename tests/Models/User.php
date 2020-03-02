<?php

namespace ChinLeung\Factories\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    /**
     * Relationship with the pets table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class);
    }
}
