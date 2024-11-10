<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

/**
 * Class Chatroom
 *
 * @property string $id
 * @property string $slug
 * @property string|null $name
 * @property string|null $description
 * @property string|null $icon
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
final class Chatroom extends Model
{
    use HasUuids;

    protected $fillable = [
        'slug',
        'name',
        'description',
        'icon',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'chatroom_users');
    }

    protected static function boot(): void
    {
        parent::boot();

        self::creating(fn ($chatroom) => $chatroom->slug = Str::random(10));
    }
}
