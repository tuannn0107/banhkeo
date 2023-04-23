<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $user = auth()->user();
        return view('admin.account.profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfileRequest $request
     * @param User $user
     * @param ImageService $imageService
     * @return RedirectResponse
     */
    public function update(ProfileRequest $request, User $user, ImageService $imageService): RedirectResponse
    {
        if ($request->file) {
            $request['image'] = $imageService->storeProfile($request->file);
        }

        $user->update($request->all());
        return back()->withSuccess(trans('message.saved'));
    }
}
