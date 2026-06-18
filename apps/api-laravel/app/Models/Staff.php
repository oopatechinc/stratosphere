<?php

namespace App\Models;

use App\Services\AwsFileService;
use App\Traits\HasCalendarEvent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class Staff extends Authenticatable
{
    use Notifiable, HasApiTokens, HasFactory, HasCalendarEvent, SoftDeletes;

    protected $fillable = [
        'user_id',
        'status',
        'image_url'
    ];

    protected $appends = [
        'image_url',
        'morph_class'
    ];

    const STATUS_INVITED = 'invited';
    const STATUS_ACTIVE = 'active';

    const VALIDATION_RULES = [
        ...User::VALIDATION_RULES,
        ...Address::VALIDATION_RULES,
        ...Category::ARRAY_VALIDATION_RULES,
        ...Service::ARRAY_VALIDATION_RULES,
        ...Occupation::ARRAY_VALIDATION_RULES,
        ...TimeBlock::ARRAY_VALIDATION_RULES,
    ];

    const ARRAY_VALIDATION_RULES = [
        'staff' => 'required|array',
        'staff.*.id' => 'required|integer|exists:staff,id',
        'staff.*.tenant_id' => 'required|integer|exists:tenants,id',
        'staff.*.status' => 'required|string|max:20'
    ];

    protected static function boot()
    {
        parent::boot();
        static::deleted(function (Staff $staff) {
            $staff->update(['email' => $staff->email . "_deleted_" . Str::uuid()]);
        });
    }

    /******************
     * Accessors
     ******************/
    public function morphClass(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $this->getMorphClass()
        );
    }

    public function imageUrl(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                if (empty($attributes['image_url']))  return null;

                $path = explode(config('services.aws.url'), $attributes['image_url'])[1];
                return (new AwsFileService())->getPreSignedUrl($path);
            }
        );
    }

    /******************
     *  Relationships
     *****************/

    public function user(): BelongsTo
    {
        $userInstance = new User();
        $userInstance->setConnection('pgsql');

        return $this->newBelongsTo(
            $userInstance->newQuery(),
            $this,
            'user_id',
            'id',
            'user'
        );
    }

    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function occupations(): BelongsToMany
    {
        return $this->belongsToMany(Occupation::class)->withTimestamps();
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class)->withTimestamps();
    }

    public function timeBlocks(): HasMany
    {
        return $this->hasMany(TimeBlock::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function domain(): MorphOne
    {
        return $this->morphOne(Domain::class, 'domainable');
    }
}
