<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'action',
        'user_id',
        'ip_address',
        'user_agent',
        'description',
    ];

    protected $casts = [
        'action' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function logAction($action, $description, $userId = null)
    {
        return self::create([
            'reference' => (string) \Illuminate\Support\Str::uuid(),
            'action' => $action,
            'user_id' => $userId ?? auth()->id(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'description' => $description,
        ]);
    }
}
