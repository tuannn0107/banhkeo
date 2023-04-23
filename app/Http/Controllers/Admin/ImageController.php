<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Services\ImageService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ImageController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param Image $image
     * @return Response
     * @throws Exception
     */
    public function destroy(Image $image)
    {
        $image->delete();
        return back()->withSuccess(trans('message.deleted'));
    }

    public function order(Request $request): string
    {
        foreach ($request->except('_token') as $id => $order) {
            Image::updateOrCreate(['id' => $id], ['order' => $order]);
        }

        return trans('message.updated');
    }

    /**
     * Delete the url image file
     *
     * @param Request $request
     * @param ImageService $imageService
     */
    public function delete(Request $request, ImageService $imageService)
    {
        $imageService->delete($request->url);
    }
}
