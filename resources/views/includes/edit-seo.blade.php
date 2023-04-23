@can('viewAny', App\Models\Seo::class)
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-actions">
                    <a class="" data-action="collapse"><i class="@if(isset($isShow) || $errors->any()) ti-minus @else ti-plus @endif"></i></a>
                </div>
                <h4 class="card-title mb-0">@lang('Seo')</h4>
            </div>
            <div class="card-body pt-5 table-responsive no-wrap collapse @if(isset($isShow) || $errors->any()) show @endif">
                <input type="hidden" name="seo_id" value="{{$seo?->id}}" />
                <x-input name="title" value="{{$seo?->title}}" label="Title" count-character />
                <div class="row mb-5">
                    <x-input name="slug" value="{{$seo?->canonical}}" label="Link" class="col-8 col-sm-10 col-md-11" />
                    <button id="js-slug-button" type="button" class="btn waves-effect waves-light btn-light btn-circle">
                        <i class="mdi mdi-refresh"></i>
                    </button>
                </div>
                <x-textarea name="description" value="{{$seo?->description}}" label="Description" count-character />
                <x-input name="robots" value="{{$seo?->robots}}" label="Robots" />
                <x-input name="keywords" value="{{$seo?->keywords}}" label="Keywords" />
                <x-textarea name="scripts" value="{{$seo?->scripts}}" label="Scripts" rows="10" />
            </div>
        </div>
    </div>
</div>
@endcan
