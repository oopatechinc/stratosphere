<?php

namespace App\Models;

use App\Services\AwsFileService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class CollectionItemImage extends Model
{
    protected $guarded = [];

    protected $appends = [
        'url'
    ];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function (CollectionItemImage $image) {
            (new AwsFileService())
                ->setUrl($image->url)
                ->delete();
        });
    }

    public function url(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                if (empty($attributes['url']))  return null;

                $path = explode(config('services.aws.url'), $attributes['url'])[1];
                return (new AwsFileService())->getPreSignedUrl($path);
            }
        );
    }

}
