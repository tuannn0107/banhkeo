<?php

namespace App\Services;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\ProductType;
use App\Models\Seo;
use DOMDocument;
use DOMXPath;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PostService
{
    private ImageService $imageService;

    private SeoService $seoService;

    public function __construct(ImageService $imageService, SeoService $seoService)
    {
        $this->imageService = $imageService;
        $this->seoService = $seoService;
    }


    public function __call($method, $parameters)
    {
        if (!str_starts_with($method, 'convert')) {
            return null;
        }

        $subdirectory = '';
        if (count($parameters) > 1) {
            $subdirectory = '/' . $parameters[1];
            array_pop($parameters);
        }

        return $this->convert(str($method)->substr(7)->snake() . $subdirectory, ...$parameters);
    }

    public function getCategoryList($master)
    {
        return Category::whereSlug($master)->firstOrFail()->descendantList();
    }

    /**
     * Store post
     *
     * @param PostRequest $request
     * @return mixed
     */
    public function store(PostRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $post = Post::create($request->except(array_merge(Seo::META_LIST, ['image', 'content'])));
            return $this->save($post, $request);
        });
    }

    /**
     * Update post
     *
     * @param Post $post
     * @param PostRequest $request
     * @return mixed
     */
    public function update(Post $post, PostRequest $request)
    {
        return DB::transaction(function () use ($post, $request) {
            $post->update($request->except(array_merge(Seo::META_LIST, ['image', 'content'])));
            return $this->save($post, $request);
        });
    }

    /**
     * Save post
     *
     * @param Post $post
     * @param PostRequest $request
     */
    private function save(Post $post, PostRequest $request)
    {
        if ($request->file) {
            $post->image = $this->imageService->storePost($request->file, $post->id);
        }

        $post->content = $this->convertPost($request['content'], $post->id);
        $post->user_id = auth()->id();
        $post->save();
        $post->category()->sync($request->category_id);
        $this->imageService->save($post, $request);
        $this->seoService->save($post, $request);
        ProductType::wherePostId($post->id)->delete();
        if ($request->productTypeList) {
            foreach ($request->productTypeList as $productType) {
                ProductType::create(['name' => $productType, 'post_id' => $post->id]);
            }
        }

        return $post;
    }

    /**
     * Convert external image or base64 to internal.
     *
     * @param string $path required
     * @param $content
     * @param int $width optional
     * @return string
     */
    public function convert(string $path, $content, int $width = 1024): string
    {
        $domDocument = new DOMDocument();
        @$domDocument->loadHTML($this->imageService->normalizeContent($content), 8192 | 4);
        $imgTagList = $domDocument->getElementsByTagName('img');

        foreach ($imgTagList as $imgTag) {
            $src = $imgTag->getAttribute('src');
            $imgTag->setAttribute('loading', 'lazy');
            if (str($src)->startsWith('http')) {
                try {
                    $originalFileName = head(explode('?', last(explode('/', $src))));
                    $fileName = $this->imageService->getFileName($originalFileName);
                    $imgTag->setAttribute('src', $this->imageService->store($path, $src, $fileName, $width));
                } catch (Exception $e) {
                    Log::error('PostService.transformAll() Cannot transform url ' . $src);
                }
            } else if (str($src)->startsWith('data:image')) {
                $imgTag->setAttribute('src', $this->imageService->convert($path, $src, $imgTag->getAttribute('data-filename'), $width));
            }
        }

        $domXPath = new DOMXPath($domDocument);
        $headingTagList = $domXPath->query('//h1|//h2|//h3|//h4|//h5|//h6');

        foreach ($headingTagList as $headingTag) {
            $headingTag->setAttribute('id', str($headingTag->nodeValue)->slug);
        }

        return $domDocument->saveHTML($domDocument->documentElement);
    }

    /**
     * Create the table of contents
     *
     * @param $content
     * @return string
     */
    public function toc($content): string
    {
        $toc = '';
        $domDocument = new DOMDocument();
        @$domDocument->loadHTML($this->imageService->normalizeContent($content), 8192 | 4);

        $domXPath = new DOMXPath($domDocument);
        $headingTagList = $domXPath->query('//h1|//h2|//h3|//h4|//h5|//h6');

        foreach ($headingTagList as $headingTag) {
            $toc .= str('')->padLeft((intval(Str::remove('h', $headingTag->nodeName)) - 2) * 4)
                ->append('1. [' . $headingTag->nodeValue . '](#' . str($headingTag->nodeValue)->slug . ')')
                ->newLine()->toString();
        }

        return $toc;
    }
}
