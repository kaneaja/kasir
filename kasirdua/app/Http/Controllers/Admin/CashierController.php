<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(5);
        return view('pages.admin.cashiers.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.cashiers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ' required|min:1',
            'username' => ' required|string',
            'password' => ' required|string',
        ]);
        user::create($request->all());
        return redirect()->route('cashiers.index')
        ->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = user::findOrFail($id);

        return view('pages.admin.cashiers.edit', compact(('users')));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ' required|min:1',
            'username' => ' required|string',
            'password' => ' required|string',
        ]);
        $users = user::findOrFail($id);
        $users->update($request->all());
        return redirect()->route('cashiers.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users = User::where('id', $id)
        ->delete();
        return redirect()
        ->route('cashiers.index')
        ->with('message', 'user deleted successfully');
    }
}
