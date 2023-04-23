<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageService
{
    /**
     * @param $method
     * @param $parameters [0] => $file, [1] => $subdirectory, [2] => $fileName
     * @return string|null
     */
    public function __call($method, $parameters)
    {
        if (!str_starts_with($method, 'store')) {
            return null;
        }

        $subdirectory = '';
        if (count($parameters) > 1) {
            $subdirectory = $parameters[1] ? '/' . $parameters[1] : '';
            array_splice($parameters, 1, 1);
        }

        return $this->store(str($method)->substr(5)->kebab() . $subdirectory, ...$parameters);
    }

    /**
     * Update image
     *
     * @param $model
     * @param $request
     */
    public function save($model, $request)
    {
        $imageList = [];
        if ($request->fileList) {
            foreach ($request->fileList as $file) {
                $imageList[] = ['image' => $this->storePost($file, $model->id)];
            }
            $model->imageList()->createMany($imageList);
        }
    }

    /**
     * Convert base64 to image.
     *
     * @param string $base64 required
     * @param string $path required
     * @param null $fileName optional
     * @param int $width optional
     * @return string $imageUrl
     */
    public function convert(string $path, string $base64, $fileName = null, int $width = 1024): string
    {
        // Sample: data:image/jpeg;base64,abc
        list($extension, $content) = explode(";base64,", $base64);
        list(, $extension) = explode('image/', str($extension)->replaceFirst('jpeg', 'jpg'));
        return $this->store($path, base64_decode($content), $this->generateFileName($fileName, $extension), $width);
    }

    /**
     * Store image to internal.
     *
     * @param $file $request->file | base64_decode()
     * @param string $path required
     * @param null $fileName optional, $fileName is null: $request->file, $fileName is not null: base64_decode()
     * @param int $width optional
     * @return string $imageUrl
     */
    public function store(string $path, $file, $fileName = null, int $width = 1920): string
    {
        $content = $file;
        if ($file instanceof UploadedFile) {
            $fileName = $fileName ?? $this->getFileName($file->getClientOriginalName(), $file->extension());
            $content = file_get_contents($file);
        }

        info('ImageService.storeRequest() ' . $path . '/' . $fileName);

        if (!str($fileName)->lower()->endsWith(['svg', 'gif', 'riff', 'webp'])) {
            $image = Image::make($file);
            $image->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $content = (string)$image->encode();
        }

        Storage::put($path . '/' . $fileName, $content);
        return Storage::url($path . '/' . $fileName);
    }

    public function delete($path)
    {
        if (str($path)->startsWith(config('constants.folder.upload'))) {
            File::delete($this->relativePath($path));
            info('ImageService.delete() ' . $path);
        }
    }

    public function deleteDirectory($path)
    {
        if (str($path)->startsWith(config('constants.folder.upload'))) {
            File::deleteDirectory($this->relativePath($path));
            info('ImageService.deleteDirectory() ' . $path);
        }
    }

    public function normalizeContent($content)
    {
        $content = !$content ? '<br>' : (str($content)->startsWith('<h') ? '<span></span>' : '') . $content;
        return mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8');
    }

    public function getFileName($fileName, $extension = null)
    {
        $pathInfo = pathinfo($fileName);
        $extension = $extension ?? $pathInfo['extension'];
        return str($pathInfo['filename'])->slug() . str('-' . str()->random(3) . '.' . $extension)->lower();
    }

    private function relativePath($path)
    {
        return ltrim($path, '/');
    }

    private function generateFileName($fileName, $extension)
    {
        if ($fileName) {
            return $this->getFileName($fileName);
        }

        return str(str()->random(5))->lower() . '.' . $extension;
    }
}
