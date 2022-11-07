<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id;
 * @property string $firstName;
 * @property string $lastName;
 * @property string $birthday;
 * @property string $biography;
 * @property string $gender;
 * @property string $placeOfBirth;
 */
class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
    ];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
