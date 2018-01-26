<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cocur\Slugify\Slugify;
use Cviebrock\EloquentSluggable\Sluggable;
use Kyslik\ColumnSortable\Sortable;
use Cviebrock\EloquentTaggable\Taggable;
use Laravel\Scout\Searchable;
use Illuminate\Support\Carbon;

Carbon::setLocale('el');

class Post extends Model {

    use Taggable;

    protected $fillable = [
        'title',
        'seotitle',
        'postbody',
        'sortdesc',
        'order',
        'metatitle',
        'metadesc',
        'metakeywords',
        'active',
        'created_at',
        'updated_at',
    ];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     *
     */
    public function getRouteKeyName() {
        return 'seotitle';
    }

/**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    use Sluggable;

    public function sluggable() {
        return [
            'seotitle' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * @param \Cocur\Slugify\Slugify $engine
     * @param string $attribute
     * @return \Cocur\Slugify\Slugify
     */
    public function customizeSlugEngine(Slugify $engine, $attribute) {
        $engine->addRule('χ', 'x');
        $engine->addRule('Χ', 'x');
        $engine->addRule('ξ', 'x');
        $engine->addRule('Ξ', 'x');
        $engine->addRule('αυ', 'af');

        return $engine;
    }

/**
     *
     */
    use Sortable;

    public $sortable = [
        'id',
        'title',
        'active',
        'order',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the index name for the model.
     * Scout Search
     * @return string
     */
    use Searchable;

    public function toSearchableArray() {
        $array = $this->toArray();


        return $array;
    }

    /**
     * Get the index name for the model.
     * Scout Search usually with external algolia driver
     * @return string
     */
    public function searchableAs() {
        return 'posts_index';
    }

}
