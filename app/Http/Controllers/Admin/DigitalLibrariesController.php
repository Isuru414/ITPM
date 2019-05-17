<?php

namespace App\Http\Controllers\Admin;

use App\DigitalLibrary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDigitalLibrariesRequest;
use App\Http\Requests\Admin\UpdateDigitalLibrariesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class DigitalLibrariesController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of DigitalLibrary.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('digital_library_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('digital_library_delete')) {
                return abort(401);
            }
            $digital_libraries = DigitalLibrary::onlyTrashed()->get();
        } else {
            $digital_libraries = DigitalLibrary::all();
        }

        return view('admin.digital_libraries.index', compact('digital_libraries'));
    }

    /**
     * Show the form for creating new DigitalLibrary.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('digital_library_create')) {
            return abort(401);
        }
        return view('admin.digital_libraries.create');
    }

    /**
     * Store a newly created DigitalLibrary in storage.
     *
     * @param  \App\Http\Requests\StoreDigitalLibrariesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDigitalLibrariesRequest $request)
    {
        if (! Gate::allows('digital_library_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $digital_library = DigitalLibrary::create($request->all());


        foreach ($request->input('digital_library_files_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $digital_library->id;
            $file->save();
        }

        return redirect()->route('admin.digital_libraries.index');
    }


    /**
     * Show the form for editing DigitalLibrary.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('digital_library_edit')) {
            return abort(401);
        }
        $digital_library = DigitalLibrary::findOrFail($id);

        return view('admin.digital_libraries.edit', compact('digital_library'));
    }

    /**
     * Update DigitalLibrary in storage.
     *
     * @param  \App\Http\Requests\UpdateDigitalLibrariesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDigitalLibrariesRequest $request, $id)
    {
        if (! Gate::allows('digital_library_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $digital_library = DigitalLibrary::findOrFail($id);
        $digital_library->update($request->all());


        $media = [];
        foreach ($request->input('digital_library_files_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $digital_library->id;
            $file->save();
            $media[] = $file->toArray();
        }
        $digital_library->updateMedia($media, 'digital_library_files');

        return redirect()->route('admin.digital_libraries.index');
    }


    /**
     * Display DigitalLibrary.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('digital_library_view')) {
            return abort(401);
        }
        $digital_library = DigitalLibrary::findOrFail($id);

        return view('admin.digital_libraries.show', compact('digital_library'));
    }


    /**
     * Remove DigitalLibrary from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('digital_library_delete')) {
            return abort(401);
        }
        $digital_library = DigitalLibrary::findOrFail($id);
        $digital_library->deletePreservingMedia();

        return redirect()->route('admin.digital_libraries.index');
    }

    /**
     * Delete all selected DigitalLibrary at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('digital_library_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = DigitalLibrary::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->deletePreservingMedia();
            }
        }
    }


    /**
     * Restore DigitalLibrary from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('digital_library_delete')) {
            return abort(401);
        }
        $digital_library = DigitalLibrary::onlyTrashed()->findOrFail($id);
        $digital_library->restore();

        return redirect()->route('admin.digital_libraries.index');
    }

    /**
     * Permanently delete DigitalLibrary from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('digital_library_delete')) {
            return abort(401);
        }
        $digital_library = DigitalLibrary::onlyTrashed()->findOrFail($id);
        $digital_library->forceDelete();

        return redirect()->route('admin.digital_libraries.index');
    }
}
