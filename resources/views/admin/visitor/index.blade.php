@extends('admin.layouts.app')

@section('title', __('Visitor List'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-lg-right mb-3">
                        @foreach($timeList as $time)
                            <a class="btn btn-sm {{$time['day'] == $day ? 'btn-success disabled' : 'btn-outline-success'}} mr-1 mb-1"
                               href="{{ route('visitor.index', ['day' => $time['day']]) }}">
                                <i class="fa fa-clock"></i> @lang($time['label'])</a>
                        @endforeach
                    </div>
                    <h4 class="card-title mb-4">@lang('Visitor List')</h4>
                    <div class="table-responsive">
                        <table
                            class="table table-striped table-bordered display js-datatable-search w-100">
                            <thead>
                            <tr>
                                <th class="js-input"></th>
                                <th class="js-input">@lang('Source')</th>
                                <th class="js-input">@lang('Search IP')</th>
                                <th class="js-input">@lang('Region')</th>
                                <th class="js-select">@lang('3G/4G')</th>
                                <th class="js-select">@lang('Proxy')</th>
                                <th class="js-input">@lang('Browser')</th>
                                <th class="js-input"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($visitorList as $visitor)
                                <tr>
                                    <td>{{$visitor->id}}</td>
                                    <td>{{$visitor->source}}</td>
                                    <td id="js-{{$loop->index}}" data-toggle="popover" data-trigger="hover"
                                        data-html="true" data-container="#js-{{$loop->index}}"
                                        data-content="{{$visitor->popover}}">{{$visitor->ip}}</td>
                                    <td>{{$visitor->region}}</td>
                                    <td>{{$visitor->mobile}}</td>
                                    <td>{{$visitor->proxy}}</td>
                                    <td>{{$visitor->user_agent}}</td>
                                    <td>{{$visitor->created_at}}</td>
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

@push('css')
    <style>
        thead input {
            width: 100%;
            font-weight: 500;
            border: none;
            color: #757575;
        }

        thead select {
            font-weight: 500;
            border: none;
            color: #757575;
        }

        .dataTables_length, .dataTables_info {
            float: left;
        }
    </style>
@endpush

@push('js')
    <script src="/js/admin/dataTables.buttons.min.js"></script>
    <script src="/js/admin/jszip.min.js"></script>
    <script src="/js/admin/buttons.html5.min.js"></script>
    <script>
        $(function () {
            $('.js-datatable-search thead th.js-input').each(function () {
                $(this).html(`<input type="text" placeholder="${$(this).text()}" />`);
            });

            $('.js-datatable-search').DataTable({
                responsive: true,
                dom: 'lBfrtip',
                buttons: ['excel'],
                columnDefs: [
                    {orderable: false, targets: [4, 5]}
                ],
                order: [[0, "desc"]],
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, Language.all]],
                initComplete: function () {
                    this.api().columns().every(function () {
                        let column = this;
                        if ($(column.header()).hasClass('js-input')) {
                            $('input', this.header()).on('keyup change clear', function () {
                                if (column.search() !== this.value) {
                                    column.search(this.value).draw();
                                }
                            });
                        } else if ($(column.header()).hasClass('js-select')) {
                            let select = $('<select><option value="">' + $(column.header()).text().trim() + '</option></select>')
                                .appendTo($(column.header()).empty())
                                .on('change', function () {
                                    let val = $.fn.dataTable.util.escapeRegex($(this).val());
                                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                                });

                            column.data().unique().sort().each(function (d, j) {
                                select.append('<option value="' + d + '">' + d + '</option>');
                            });
                        }
                    });
                }
            });
            $('.buttons-excel').addClass('btn btn-sm btn-light ml-2 mb-1 float-right');
        });
    </script>
@endpush
