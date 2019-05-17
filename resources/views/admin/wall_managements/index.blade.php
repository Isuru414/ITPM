@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.wall-management.title')</h3>
    @can('wall_management_create')
    <p>
        <a href="{{ route('admin.wall_managements.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    @can('wall_management_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.wall_managements.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.wall_managements.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($wall_managements) > 0 ? 'datatable' : '' }} @can('wall_management_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('wall_management_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('quickadmin.wall-management.fields.date')</th>
                        <th>@lang('quickadmin.wall-management.fields.image')</th>
                        <th>@lang('quickadmin.wall-management.fields.title')</th>
                        <th>@lang('quickadmin.wall-management.fields.description')</th>
                        <th>@lang('quickadmin.wall-management.fields.notice-files')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($wall_managements) > 0)
                        @foreach ($wall_managements as $wall_management)
                            <tr data-entry-id="{{ $wall_management->id }}">
                                @can('wall_management_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='date'>{{ $wall_management->date }}</td>
                                <td field-key='image'>@if($wall_management->image)<a href="{{ asset(env('UPLOAD_PATH').'/' . $wall_management->image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $wall_management->image) }}"/></a>@endif</td>
                                <td field-key='title'>{{ $wall_management->title }}</td>
                                <td field-key='description'>{!! $wall_management->description !!}</td>
                                <td field-key='notice_files'>@if($wall_management->notice_files)<a href="{{ asset(env('UPLOAD_PATH').'/' . $wall_management->notice_files) }}" target="_blank">Download file</a>@endif</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('wall_management_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.wall_managements.restore', $wall_management->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('wall_management_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.wall_managements.perma_del', $wall_management->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('wall_management_view')
                                    <a href="{{ route('admin.wall_managements.show',[$wall_management->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('wall_management_edit')
                                    <a href="{{ route('admin.wall_managements.edit',[$wall_management->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('wall_management_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.wall_managements.destroy', $wall_management->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('wall_management_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.wall_managements.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection