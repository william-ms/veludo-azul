<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'phone',
    ];

    public function getFormattedPhoneAttribute() : string
    {
        $phone = $this->attributes['phone'];
        $phone = "(".substr($phone,0,2).") ".substr($phone,2,-4)."-".substr($phone,-4);
        return $phone;
    }
}
