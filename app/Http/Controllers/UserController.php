<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index(Request $request)
    {
        if (!$request->ajax()) {
            return view('users.index');
        }

        if ($request->ajax()) {
            $data = User::select(['id', 'name', 'email', 'gender', 'dob', 'phone_no', 'address', 'created_at']);
            return DataTables::of($data)
                ->addColumn('created_at', function ($row) {
                    return  $row->created_at->diffForHumans();
                })
                ->rawColumns(['created_at'])
                ->make(true);
        }
    }

    /**
     * Display the specified user.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.partials', compact('user'));
    }
}
