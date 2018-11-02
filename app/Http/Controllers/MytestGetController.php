<?php

namespace App\Http\Controllers;

use App\Mytest;
use Yajra\DataTables\Facades\DataTables;

class MytestGetController extends Controller
{
    public function index()
    {
        // return DataTables::eloquent(Mytest::query())->make(true);
        try
        {
            $mytests = Mytest::select(['id', 'name', 'cnum', 'email', 'address']);

            return DataTables::of($mytests)
                ->addColumn('action', function ($mytests) {
                    return '<button mytest_id="' . $mytests->id . '" class="btn btn-xs btn-primary edit"><i class="glyphicon glyphicon-edit"></i> Edit</button> <button mytest_id="' . $mytests->id . '" class="btn btn-xs btn-danger delete"><i class="glyphicon glyphicon-trash"></i> Delete</button>';
                })
                ->make(true);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }
}
