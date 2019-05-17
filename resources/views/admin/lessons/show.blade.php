@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.lessons.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.lessons.fields.course')</th>
                            <td field-key='course'>{{ $lesson->course->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.lessons.fields.title')</th>
                            <td field-key='title'>{{ $lesson->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.lessons.fields.downloadable-files')</th>
                            <td field-key='downloadable_files's> @foreach($lesson->getMedia('downloadable_files') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.lessons.fields.published')</th>
                            <td field-key='published'>{{ Form::checkbox("published", 1, $lesson->published == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.lessons.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop


