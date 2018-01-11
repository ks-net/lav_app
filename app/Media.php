<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Kyslik\ColumnSortable\Sortable;
use Cviebrock\EloquentTaggable\Taggable;
use Illuminate\Support\Carbon;

Carbon::setLocale('el');

class Media extends Model {

    use Taggable;

    protected $fillable = [
        'name',
        'desc',
        'image',
        'image_medium',
        'image_thumb',
        'slug',
        'order',
        'active',
        'created_at',
        'updated_at',
    ];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    use Sluggable;

    public function sluggable() {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

/**
     *
     */
    use Sortable;

    public $sortable = [
        'id',
        'name',
        'active',
        'created_at',
        'updated_at',
    ];

}
