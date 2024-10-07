<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use Str, Hash;

class UserController extends Controller
{
    public function index(Request $request): View {
        $users = User::paginate(10);

        return view('users.index', compact('users'));
    }

    public function create() {
        abort(404);
        return view('users.create');
    }

    public function store(Request $request): RedirectResponse {
        abort(403);
        $input = $request->validate([
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'email' => 'required|email|unique:users,email',
            'email_verified_at' => 'nullable',
            'phone_number' => 'nullable',
            'role' => 'required',
            'location' => 'nullable',
            'payment_status' => 'nullable',
        ]);
        $input['password'] = Hash::make(Str::random(10));
        $user = User::create($input);

        return redirect()->route('users.index');
    }

    public function edit($id) {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id) {
        $input = $request->validate([
            'name' => 'nullable',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone_number' => 'nullable',
            'gender' => 'nullable',
        ]);

        $user = User::whereId($id)->update($input);

        return redirect()->route('users.index');
    }

    public function destroy($id) {
        abort(403);
        User::destroy($id);
        return redirect()->route('users.index');
    }

    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

}
