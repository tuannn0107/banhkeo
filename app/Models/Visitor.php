<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'use_mobile_connection' => 'boolean',
        'use_proxy' => 'boolean',
        'status' => 'boolean'
    ];

    public function getMobileAttribute()
    {
        return $this->use_mobile_connection ? trans('Yes') : trans('No');
    }

    public function getProxyAttribute()
    {
        return $this->use_proxy ? trans('Yes') : trans('No');
    }

    public function getPopoverAttribute()
    {
        return sprintf(trans('Coordinates') . ': %s, %s<br>'
            . trans('Timezone') . ': %s<br>'
            . trans('AS') . ': %s<br>'
            . trans('Organization') . ': %s<br>'
            . trans('Country') . ': %s<br>',
            $this->latitude, $this->longitude, $this->timezone, $this->as, $this->organization, $this->country);

    }
}
