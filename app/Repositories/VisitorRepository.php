<?php

namespace App\Repositories;

use App\Repositories\Interfaces\VisitorRepositoryInterface;

class VisitorRepository implements VisitorRepositoryInterface
{
    public function updateLocation($visitor, $location)
    {
        $visitor->region = $location['regionName'] ?? '';
        $visitor->country = $location['country'] ?? '';
        $visitor->latitude = $location['lat'] ?? '';
        $visitor->longitude = $location['lon'] ?? '';
        $visitor->timezone = $location['timezone'] ?? '';
        $visitor->organization = $location['org'] ?? '';
        $visitor->as = $location['as'] ?? '';
        $visitor->use_mobile_connection = $location['mobile'] ?? 0;
        $visitor->use_proxy = $location['proxy'] ?? 0;
        $visitor->status = 1;
        $visitor->save();
    }

    public function updateFailedStatus($visitor)
    {
        $visitor->status = 0;
        $visitor->save();
    }
}
