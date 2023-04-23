<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VisitorRequest;
use App\Models\Visitor;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\Response as HttpClientResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class VisitorController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Visitor::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request): View
    {
        $day = $request->day ?? 0;
        $visitorList = Visitor::when(in_array($day, [0, 1]), function ($query) use ($day) {
            $query->whereDate('created_at', today()->subDays($day));
        })->when(!in_array($day, [-1, 0, 1]), function ($query) use ($day) {
            $query->whereDate('created_at', '>=', today()->subDays($day));
        })->get();

        $timeList = $this->timeList();
        return view('admin.visitor.index', compact('visitorList', 'day', 'timeList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $visitorList = Visitor::all();
        return view('admin.visitor.index', compact('visitorList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VisitorRequest $visitorRequest
     * @return HttpClientResponse
     */
    public function store(VisitorRequest $visitorRequest): HttpClientResponse
    {
        return Http::get('http://ip-api.com/json/' . $visitorRequest->ip . '?fields=status,country,regionName,lat,lon,timezone,isp,org,as,mobile,proxy');
    }

    /**
     * Display the specified resource.
     *
     * @param int $day
     * @return void
     */
    public function show(int $day)
    {
        // NOP
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Visitor $visitor
     * @return View
     */
    public function edit(Visitor $visitor): View
    {
        $visitorList = Visitor::all();
        return view('admin.visitor.index', compact('visitor', 'visitorList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param VisitorRequest $visitorRequest
     * @param Visitor $visitor
     * @return RedirectResponse
     */
    public function update(VisitorRequest $visitorRequest, Visitor $visitor): RedirectResponse
    {
        $visitor->update($visitorRequest->all());
        return to_route('visitor.index')->withSuccess(trans('message.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Visitor $visitor
     * @return RedirectResponse
     */
    public function destroy(Visitor $visitor): RedirectResponse
    {
        $visitor->delete();
        return back()->withSuccess(trans('message.deleted'));
    }

    private function timeList(): Collection
    {
        return collect([
            ['day' => 0, 'label' => 'Today'],
            ['day' => 1, 'label' => 'Yesterday'],
            ['day' => 7, 'label' => 'Last 7 days'],
            ['day' => 28, 'label' => 'Last 28 days'],
            ['day' => 90, 'label' => 'Last 90 days'],
            ['day' => -1, 'label' => 'All'],
        ]);
    }
}
