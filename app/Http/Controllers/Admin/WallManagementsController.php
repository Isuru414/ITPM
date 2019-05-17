<?php

namespace App\Http\Controllers\Admin;

use App\WallManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreWallManagementsRequest;
use App\Http\Requests\Admin\UpdateWallManagementsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class WallManagementsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of WallManagement.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('wall_management_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('wall_management_delete')) {
                return abort(401);
            }
            $wall_managements = WallManagement::onlyTrashed()->get();
        } else {
            $wall_managements = WallManagement::all();
        }

        return view('admin.wall_managements.index', compact('wall_managements'));
    }

    /**
     * Show the form for creating new WallManagement.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('wall_management_create')) {
            return abort(401);
        }
        return view('admin.wall_managements.create');
    }

    /**
     * Store a newly created WallManagement in storage.
     *
     * @param  \App\Http\Requests\StoreWallManagementsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWallManagementsRequest $request)
    {
        if (! Gate::allows('wall_management_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $wall_management = WallManagement::create($request->all());



        return redirect()->route('admin.wall_managements.index');
    }


    /**
     * Show the form for editing WallManagement.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('wall_management_edit')) {
            return abort(401);
        }
        $wall_management = WallManagement::findOrFail($id);

        return view('admin.wall_managements.edit', compact('wall_management'));
    }

    /**
     * Update WallManagement in storage.
     *
     * @param  \App\Http\Requests\UpdateWallManagementsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWallManagementsRequest $request, $id)
    {
        if (! Gate::allows('wall_management_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $wall_management = WallManagement::findOrFail($id);
        $wall_management->update($request->all());



        return redirect()->route('admin.wall_managements.index');
    }


    /**
     * Display WallManagement.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('wall_management_view')) {
            return abort(401);
        }
        $wall_management = WallManagement::findOrFail($id);

        return view('admin.wall_managements.show', compact('wall_management'));
    }


    /**
     * Remove WallManagement from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('wall_management_delete')) {
            return abort(401);
        }
        $wall_management = WallManagement::findOrFail($id);
        $wall_management->delete();

        return redirect()->route('admin.wall_managements.index');
    }

    /**
     * Delete all selected WallManagement at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('wall_management_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = WallManagement::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore WallManagement from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('wall_management_delete')) {
            return abort(401);
        }
        $wall_management = WallManagement::onlyTrashed()->findOrFail($id);
        $wall_management->restore();

        return redirect()->route('admin.wall_managements.index');
    }

    /**
     * Permanently delete WallManagement from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('wall_management_delete')) {
            return abort(401);
        }
        $wall_management = WallManagement::onlyTrashed()->findOrFail($id);
        $wall_management->forceDelete();

        return redirect()->route('admin.wall_managements.index');
    }
}
