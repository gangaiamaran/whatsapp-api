<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ChatroomUser
 *
 * @property string $id
 * @property string $chatroom_id
 * @property string $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Chatroom $chatroom
 * @property User $user
 */
final class ChatroomUser extends Model
{
    use HasUuids;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $casts = [
        'chatroom_id' => 'int',
        'user_id' => 'int',
    ];

    protected $fillable = [
        'chatroom_id',
        'user_id',
    ];

    public function chatroom(): BelongsTo
    {
        return $this->belongsTo(Chatroom::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
