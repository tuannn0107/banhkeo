<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeoRequest;
use App\Models\Seo;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Seo::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $seoList = Seo::all();
        return view('admin.seo.index', compact('seoList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $seoList = Seo::all();
        return view('admin.seo.index', compact('seoList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SeoRequest $seoRequest
     * @return RedirectResponse
     */
    public function store(SeoRequest $seoRequest): RedirectResponse
    {
        Seo::create($seoRequest->all());
        return back()->withSuccess(trans('message.saved'));
    }

    /**
     * Display the specified resource.
     *
     * @param Seo $seo
     * @return View
     */
    public function show(Seo $seo): View
    {
        return view('admin.seo.show', compact('seo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Seo $seo
     * @return View
     */
    public function edit(Seo $seo): View
    {
        $seoList = Seo::all();
        return view('admin.seo.index', compact('seo', 'seoList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SeoRequest $seoRequest
     * @param Seo $seo
     * @return RedirectResponse
     */
    public function update(SeoRequest $seoRequest, Seo $seo): RedirectResponse
    {
        $seo->update($seoRequest->all());
        $seo->seoable()->update(['slug' => $seoRequest->slug]);
        return to_route('seo.index')->withSuccess(trans('message.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Seo $seo
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Seo $seo): RedirectResponse
    {
        $seo->delete();
        return back()->withSuccess(trans('message.deleted'));
    }

    public function generateSlug(Request $request) {
        return $request->title ? str($request->title)->slug() : '';
    }
}
