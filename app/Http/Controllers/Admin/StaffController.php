<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Str, Hash;

class StaffController extends Controller
{
    public function index(Request $request): View {
        $staff = Staff::whereNot('role', 1)->paginate(10);

        return view('staff.index', compact('staff'));
    }

    public function create() {
        return view('staff.create');
    }

    public function store(Request $request): RedirectResponse {
        $input = $request->validate([
            'name' => 'nullable',
            'email' => 'required|email|unique:staff,email',
            'email_verified_at' => 'nullable',
            'password' => 'required|confirmed',
            'role' => 'required',
        ]);
        $input['password'] = Hash::make(Str::random(10));
        $staff = Staff::create($input);

        return redirect()->route('staff.index');
    }

    public function edit($id) {
        $staff = Staff::whereNot('role', 1)->findOrFail($id);
        return view('staff.edit', compact('staff'));
    }

    public function update(Request $request, $id) {
        $input = $request->validate([
            'name' => 'nullable',
            'email' => 'required|email|unique:staff,email,'.$id,
            'password' => 'nullable|confirmed',
            'password_confirmation' => 'nullable|required_with:password',
        ]);

        $input = collect($input)->only(['name', 'email']);
        
        if($request->has('password') && !empty($request->password)) {
            $input['password'] = Hash::make($request->password);
        }
        
        $staff = Staff::whereNot('role', 1)->whereId($id)->update($input->toArray());

        return redirect()->route('staff.index');
    }

    public function destroy($id) {
        Staff::whereNot('role', 1)->delete($id);
        return redirect()->route('staff.index');
    }
}
