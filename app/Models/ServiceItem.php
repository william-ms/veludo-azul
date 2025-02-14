<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'service_id',
        'piece',
        'color',
        'type',
        'value',
        'changed_value',
    ];

    public function getTypeAttribute(): array
    {
        return explode('|', $this->attributes['type']);
    }
}
