<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $id = auth()->id();
        return view('admin.account.password', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PasswordRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(PasswordRequest $request, User $user): RedirectResponse
    {
        $user->update($request->merge(['password' => Hash::make($request->new_password)])->only('password'));
        return back()->withSuccess(trans('message.saved'));
    }
}
