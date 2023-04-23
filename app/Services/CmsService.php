<?php

namespace App\Services;

use DOMDocument;
use DOMXPath;
use Illuminate\Support\Collection;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class CmsService
{
    /**
     * Generate data-cms attribute for all img and child tag contains text.
     *
     * @param $fileName $fileName.blade.php | null: all file *.blade.php
     * @param string $prefix
     * @param string $directoryPath
     */
    public function generate($fileName, string $prefix = '', string $directoryPath = 'resources/views/home'): void
    {
        $fileList = new RecursiveDirectoryIterator($directoryPath);

        foreach (new RecursiveIteratorIterator($fileList) as $file) {
            if ($file->getExtension() == 'php') {
                if ($fileName) {
                    $inputFilePath = $this->resolvePath($fileName, $directoryPath);
                    $shortFileName = $fileName;
                    $outputFilePath = $this->resolvePath($prefix . $shortFileName, $directoryPath);
                } else {
                    $inputFilePath = $file;
                    $shortFileName = str($inputFilePath)->replace($directoryPath, '')
                        ->replace('\\', '/')->ltrim('/')->replace('.blade.php', '');
                    $outputFilePath = $this->resolvePath($prefix . $shortFileName, $directoryPath);
                }

                $hasDoctype = $this->beforeGenerate($inputFilePath, $outputFilePath);
                $domDocument = new DOMDocument();
                @$domDocument->loadHTMLFile($outputFilePath);
                $domXPath = new DOMXPath($domDocument);

                $dataCmsList = $domXPath->query("//*[@data-cms]");
                foreach ($dataCmsList as $dataCms) {
                    $dataCms->removeAttribute('data-cms');
                }

                $tagList = $domXPath->query("//body//*");
                $fileNameSlug = str($shortFileName)->replace('/', '-')->slug();
                foreach ($tagList as $index => $tag) {
                    if ($tag->hasChildNodes()) {
                        if ($tag->firstChild->nodeType === 3 && $tag->childNodes->length === 1 && !empty(trim($tag->nodeValue))) {
                            if ('a' === $tag->nodeName) {
                                if (!str($tag->getAttribute('href'))->startsWith("#")
                                    && !str($tag->getAttribute('href'))->startsWith("/")
                                    && !str($tag->getAttribute('href'))->startsWith("http")) {
                                    $tag->setAttribute('data-cms', $fileNameSlug . '-' . $index);
                                }
                            } else {
                                $tag->setAttribute('data-cms', $fileNameSlug . '-' . $index);
                            }
                        }
                    } else if ('img' === $tag->nodeName) {
                        $tag->setAttribute('data-cms', $fileNameSlug . '-' . $index);
                    }
                }

                $this->afterGenerate($outputFilePath, $domDocument->saveHTML(), $hasDoctype);

                if ($fileName) {
                    break;
                }
            }
        }
    }

    /**
     * Validate all file in resources/views/home/*.blade.php
     *
     * @param $fileName
     * @param string $directoryPath
     * @return Collection duplicate data-cms
     */
    public function validate($fileName, string $directoryPath = 'resources/views/home'): Collection
    {
        $fileList = new RecursiveDirectoryIterator($directoryPath);
        $dataCmsValueList = collect();
        $textNoTagList = collect();

        foreach (new RecursiveIteratorIterator($fileList) as $file) {
            if ($file->getExtension() == 'php') {
                $domDocument = new DOMDocument();
                if ($fileName) {
                    $content = $this->normalizeContent($this->resolvePath($fileName, $directoryPath));
                } else {
                    $content = $this->normalizeContent($file);
                }

                @$domDocument->loadHTML($content);
                $domXPath = new DOMXPath($domDocument);
                $dataCmsList = $domXPath->query("//*[@data-cms]");
                foreach ($dataCmsList as $dataCms) {
                    $dataCmsValueList->push($dataCms->getAttribute('data-cms'));
                }

                $tagList = $domXPath->query("//body//*");
                foreach ($tagList as $index => $tag) {
                    if ($tag->hasChildNodes() && $tag->firstChild->nodeType === 3 && $tag->childNodes->length > 1) {
                        foreach ($tag->childNodes as $childNode) {
                            if (!$childNode->hasChildNodes() && !empty(trim($childNode->nodeValue))
                                && !str($childNode->nodeValue)->trim()->startsWith('@')) {
                                $textNoTagList->push(str($childNode->nodeValue)->trim()->limit(30, ''));
                            }
                        }
                    }
                }

                if ($fileName) {
                    break;
                }
            }
        }

        return collect([
            'duplicate' => $dataCmsValueList->duplicates()->unique()->flatten(),
            'noTag' => $textNoTagList->unique()->flatten()
        ]);
    }

    private function resolvePath($fileName, $directoryPath)
    {
        return $directoryPath . '/' . $fileName . '.blade.php';
    }

    private function beforeGenerate(string $inputFilePath, string $outputFilePath): bool
    {
        $content = file_get_contents($inputFilePath);
        $content = str($content)
            ->replaceMatches('/<br\s*\/?>/i', 'br-cms-')
            ->replace('@cms', '<style>@cms</style>')
            ->replace('@', 'at-cms-')
            ->replace('&nbsp;', '');
        $hasDoctype = str($content)->lower()->startsWith('<!doctype');

        if (!$hasDoctype) {
            $content = '<!DOCTYPE html><html lang="vi"><head>' . $this->getMeta() . '</head><body>' . $content;
        } else {
            $content = str($content)->replace("<head>", '<head>' . $this->getMeta());
        }
        file_put_contents($outputFilePath, $content);

        return $hasDoctype;
    }

    private function afterGenerate(string $outputFilePath, $content, $hasDoctype): void
    {
        if (!$hasDoctype) {
            $content = str($content)
                ->remove("<!DOCTYPE html>\n")
                ->remove('<html lang="vi"><head>' . $this->getMeta() . '</head><body>')
                ->remove("\n</body></html>");
        } else {
            $content = str($content)->replace('<head>' . $this->getMeta(), '<head>');
        }

        $content = html_entity_decode(urldecode(str($content)
            ->replace('br-cms-', '<br>')
            ->replace('<style>at-cms-cms</style>', '@cms')
            ->replace('at-cms-', '@')->toString()));
        file_put_contents($outputFilePath, $content);
    }

    private function normalizeContent(string $path): string|null
    {
        $content = file_get_contents($path);
        $hasDoctype = str($content)->lower()->startsWith('<!doctype');
        if (!$hasDoctype) {
            $content = '<!DOCTYPE html><html lang="vi"><head>' . $this->getMeta() . '</head><body>' . $content;
        } else {
            $content = str($content)->replace("<head>", '<head>' . $this->getMeta());
        }

        $content = preg_replace('/<br(\s+)?\/?>/i', '', $content);
        return preg_replace('{{{--.+--}}}', '', $content);
    }

    private function getMeta(): string
    {
        return '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
    }
}
