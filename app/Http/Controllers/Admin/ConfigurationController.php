<?php

namespace App\Http\Controllers\Admin;

use App\Enums\LanguageType;
use App\Http\Controllers\Controller;
use App\Http\Requests\SystemRequest;
use App\Models\Configuration;
use App\Services\ImageService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Configuration::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View|RedirectResponse
     */
    public function index(Request $request): View|RedirectResponse
    {
        if (!view()->exists('admin.configuration.' . $request->name)) {
            return redirect('/');
        }

        $languageList = LanguageType::EN->languageList();

        return view('admin.configuration.' . $request->name, compact('languageList'));
    }

    public function storeSystem(SystemRequest $request, ImageService $imageService): RedirectResponse
    {
        return $this->store($request, $imageService);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param ImageService $imageService
     * @return RedirectResponse
     */
    public function store(Request $request, ImageService $imageService): RedirectResponse
    {
        optional($request->sitemap)->move(public_path(), 'sitemap.xml');

        foreach ($request->except(['_token', 'file']) as $name => $content) {
            if (collect(['logo', 'favicon'])->contains($name)) {
                $content = $imageService->storeCommon($content, null, $name . '.png');
            }
            Configuration::updateOrCreate(['name' => $name], ['content' => $content]);
        }

        return back()->withSuccess(trans('message.saved'));
    }
}
