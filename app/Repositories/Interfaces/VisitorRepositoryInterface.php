<?php

namespace App\Repositories\Interfaces;

interface VisitorRepositoryInterface
{
    /**
     * Update the location
     *
     * @param $visitor
     * @param $location
     * @return mixed
     */
    public function updateLocation($visitor, $location);

    /**
     * Update failed status when cannot fetched location
     *
     * @param $visitor
     * @return mixed
     */
    public function updateFailedStatus($visitor);
}
