<?php

namespace Tests\Unit;

use App\Services\CmsService;
use Tests\TestCase;

class CmsServiceTest extends TestCase
{
    private CmsService $cmsService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->cmsService = app()->make(CmsService::class);
    }

    /**
     * Test generate data-cms for html.
     *
     * @return void
     */
    public function test_html_cms()
    {
        $this->cmsService->generate('html', 'actual-', 'tests/Data');
        $this->assertEqualsIgnoringCase(file_get_contents('tests/Data/expected-html.blade.php'),
            file_get_contents('tests/Data/actual-html.blade.php'));
    }

    /**
     * Test generate data-cms for blade.
     *
     * @return void
     */
    public function test_blade_cms()
    {
        $this->cmsService->generate('blade', 'actual-', 'tests/Data');
        $actual = file_get_contents('tests/Data/actual-blade.blade.php');
        $expected = file_get_contents('tests/Data/expected-blade.blade.php');
        $this->assertEqualsIgnoringCase($expected, $actual);
    }

    /**
     * Test generate data-cms for blade.
     *
     * @return void
     */
    public function test_validate_cms()
    {
        $actualErrorList = $this->cmsService->validate('validation', 'tests/Data');
        $expectedErrorList = collect(['duplicate' => collect(["test-1"]), 'noTag' => collect([])]);
        $this->assertEquals($expectedErrorList, $actualErrorList);
    }
}
