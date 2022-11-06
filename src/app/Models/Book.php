<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string title;
 * @property string releaseDate;
 * @property string description;
 * @property string isbn;
 * @property string format;
 * @property int $numberOfPages;
 * @property Author $author;
 */
class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'releaseDate',
        'description',
        'isbn',
        'format',
        'numberOfPages',
    ];

    protected $casts = [
        'numberOfPages' => 'integer',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
}
