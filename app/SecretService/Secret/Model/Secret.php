<?php

namespace App\SecretService\Secret\Model;

use App\SecretService\Secret\Event\SecretRetrieved;
use App\SecretService\Secret\Listener\DeleteSecretWhenNoViewsLeft;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Event;

class Secret extends Model
{
    use HasUuids;

    protected $primaryKey = 'hash';

    protected $guarded = [];

    protected $casts = [
        'expires_at' => 'datetime'
    ];

    public static function boot(): void
    {
        parent::boot();

        static::retrieved(fn(Model $model) => $model->decrement('expire_after'));
    }

    public function haveViewsLeft(): bool
    {
        return $this->expire_after > 0;
    }

    protected function secretText(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => Crypt::decryptString($value),
            set: fn(string $value) => Crypt::encryptString($value),
        );
    }
}
