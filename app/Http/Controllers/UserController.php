<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function data()
    {
        $users = User::query();

        return DataTables::of($users)
          ->addIndexColumn()
          ->make(true);
    }
}
