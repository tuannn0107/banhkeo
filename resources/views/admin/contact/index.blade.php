@extends('admin.layouts.app')

@section('title', __('Contact'))

@section('content')
    @includeWhen(isset($contact), 'admin.contact.edit')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">@lang('Contact List')</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered display js-datatable w-100">
                            <thead>
                            <tr>
                                <th></th>
                                <th>@lang('Name')</th>
                                <th>@lang('Phone number')</th>
                                <th>@lang('E-Mail Address')</th>
                                <th>@lang('Address')</th>
                                <th>@lang('Content')</th>
                                <th>@lang('Creation date')</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($contactList as $contact)
                                <tr>
                                    <td>{{$contact->id}}</td>
                                    <td>{{$contact->name}}</td>
                                    <td>{{$contact->phone}}</td>
                                    <td>{{$contact->email}}</td>
                                    <td>{{$contact->address}}</td>
                                    <td>{{$contact->content}}</td>
                                    <td>{{$contact->created_at}}</td>
                                    <td><x-action route="contact" id="{{$contact->id}}" /></td>
                                </tr>
                            @empty
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
