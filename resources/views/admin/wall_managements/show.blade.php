@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.wall-management.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.wall-management.fields.date')</th>
                            <td field-key='date'>{{ $wall_management->date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.wall-management.fields.image')</th>
                            <td field-key='image'>@if($wall_management->image)<a href="{{ asset(env('UPLOAD_PATH').'/' . $wall_management->image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $wall_management->image) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.wall-management.fields.title')</th>
                            <td field-key='title'>{{ $wall_management->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.wall-management.fields.description')</th>
                            <td field-key='description'>{!! $wall_management->description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.wall-management.fields.notice-files')</th>
                            <td field-key='notice_files'>@if($wall_management->notice_files)<a href="{{ asset(env('UPLOAD_PATH').'/' . $wall_management->notice_files) }}" target="_blank">Download file</a>@endif</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.wall_managements.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
            });
            
        });
    </script>
            
@stop
