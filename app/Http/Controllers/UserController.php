<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $query = User::query();

        // Aplicar filtro de búsqueda si se proporciona un término de búsqueda
        if (request()->has('search') && request()->filled('search')) {
            $searchTerm = request()->input('search');
            $query->where('name', 'like', "%$searchTerm%")
                  ->orWhere('surname', 'like', "%$searchTerm%")
                  ->orWhere('email', 'like', "%$searchTerm%");
        }

        $recordsPerPage = request()->input('records_per_page', 10); // Valor por defecto: 10
        $users = $query->paginate($recordsPerPage);

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        User::create($input);
        return redirect('users')->with('flash_message', 'Student Addedd!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);
        return view('user.edit')->with('user', $users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $input = $request->all();
        $user->update($input);
        return redirect('users')->with('flash_message', 'user Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('users')->with('flash_message', 'Student deleted!');
    }
}
