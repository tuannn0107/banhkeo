<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CmsRequest;
use App\Models\Configuration;
use App\Services\ImageService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin.cms.index');
    }

    /**
     * Store is using in Home page
     * Store a newly created resource in storage.
     *
     * @param CmsRequest $request
     * @param ImageService $imageService
     * @return mixed
     */
    public function store(CmsRequest $request, ImageService $imageService)
    {
        if ($request->file) {
            $request['content'] = $imageService->storeCms($request->file);
        }

        return Configuration::updateOrCreate(['name' => $request->name], $request->all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Configuration $configuration
     * @return View
     */
    public function edit(Configuration $configuration): View
    {
        return view('admin.cms.index', compact('configuration'));
    }

    /**
     * Update is using in Admin page
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Configuration $configuration
     * @param ImageService $imageService
     * @return RedirectResponse
     */
    public function update(Request $request, Configuration $configuration, ImageService $imageService): RedirectResponse
    {
        if ($request->file) {
            $request['content'] = $imageService->storeCms($request->file);
        }

        $configuration->update($request->all());
        return to_route('cms.index')->withSuccess(trans('message.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Configuration $configuration
     * @return RedirectResponse
     */
    public function destroy(Configuration $configuration): RedirectResponse
    {
        $configuration->delete();
        return to_route('cms.index')->withSuccess(trans('message.deleted'));
    }
}
