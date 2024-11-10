<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MessageAttachment
 *
 * @property string $id
 * @property string $message_id
 * @property string|null $path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Message $message
 */
final class MessageAttachment extends Model
{
    use HasUuids;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'message_id',
        'path',
    ];

    public function message()
    {
        return $this->belongsTo(Message::class);
    }
}
