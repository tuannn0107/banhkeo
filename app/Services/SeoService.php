<?php

namespace App\Services;

use App\Models\Seo;

class SeoService
{
    /**
     * Update seo
     *
     * @param $model
     * @param $request
     */
    public function save($model, $request)
    {
        if (!empty(array_filter($request->only(Seo::META_LIST)))) {
            $request['canonical'] = $request->slug;
            $model->seo()->updateOrCreate(['seoable_id' => $model->id], $request->all());
        } else if ($model->seo()->exists()) {
            $model->seo()->delete();
        }
    }
}
