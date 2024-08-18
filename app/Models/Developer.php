<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'Developer',
    properties: [
        new OAT\Property(
            property: 'name',
            description: 'The name of the developer',
            type: 'string',
            example: 'John Doe'
        ),
        new OAT\Property(
            property: 'bio',
            description: 'A short bio of the developer',
            type: 'string',
            example: 'I am a developer'
        ),
    ],
    type: 'object'
)]
class Developer extends Model
{
    use HasFactory;

    /**
     * The User who created this developer.
     *
     * @return BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
