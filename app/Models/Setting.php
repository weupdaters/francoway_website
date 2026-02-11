<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'key',
        'value',
        'group',
        'label',
        'description',
        'type',
        'options',
    ];

    /**
     * Get single setting value by key
     */
    public static function getValue($key, $default = null)
    {
        return optional(
            static::where('key', $key)->first()
        )->value ?? $default;
    }

    /**
     * Get all settings as key => value array
     */
    public static function getAll($group = 'general')
    {
        return static::where('group', $group)
            ->pluck('value', 'key')
            ->toArray();
    }

    /**
     * Set / Update a setting value
     */
    public static function setValue($key, $value, $group = 'general')
    {
        return static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'group' => $group,
            ]
        );
    }
}
