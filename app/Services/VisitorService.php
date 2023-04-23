<?php


namespace App\Services;


use App\Models\Visitor;
use App\Repositories\Interfaces\VisitorRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class VisitorService
{
    private VisitorRepositoryInterface $visitorRepository;

    public function __construct(VisitorRepositoryInterface $visitorRepository)
    {
        $this->visitorRepository = $visitorRepository;
    }

    public function fetchAndSaveLocation(): void
    {
        $visitorList = Visitor::whereNull('status')->limit(45)->latest('id')->get();

        foreach ($visitorList as $visitor) {
            try {
                $location = Http::get('http://ip-api.com/json/' . $visitor->ip . '?fields=status,country,regionName,lat,lon,timezone,org,as,mobile,proxy');
                if ($location['status'] == 'success') {
                    $this->visitorRepository->updateLocation($visitor, $location);
                } else {
                    $this->visitorRepository->updateFailedStatus($visitor);
                }
            } catch (Exception $e) {
                Log::warning('Could not fetch ip: ' . $visitor->ip . '. Exception: ' . $e->getMessage());
                $this->visitorRepository->updateFailedStatus($visitor);
            }
        }
    }
}
