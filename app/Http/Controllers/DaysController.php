<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Days;

class DaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Days::query();

        // Aplicar filtro de búsqueda si se proporciona un término de búsqueda
        if (request()->has('search') && request()->filled('search')) {
            $searchTerm = request()->input('search');
            $query->where('name', 'like', "%$searchTerm%")
                  ->orWhere('color', 'like', "%$searchTerm%")
                  ->orWhere('day', 'like', "%$searchTerm%")
                  ->orWhere('month', 'like', "%$searchTerm%")
                  ->orWhere('year', 'like', "%$searchTerm%")
                  ->orWhere('recurrent', 'like', "%$searchTerm%");
        }

        $recordsPerPage = request()->input('records_per_page', 10); // Valor por defecto: 10
        $days = $query->paginate($recordsPerPage);

        return view('days.index', compact('days'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('days.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // Obtener todos los datos del formulario
      $input = $request->all();

      // Obtener la fecha del formulario
      $fecha = $input['fecha'];

      // Dividir la fecha en día, mes y año
      $partesFecha = explode('/', $fecha);
      $año = $partesFecha[2];
      $mes = $partesFecha[0];
      $día = $partesFecha[1];

      // Añadir día, mes y año a los datos del formulario
      $input['day'] = $día;
      $input['month'] = $mes;
      $input['year'] = $año;

      // Eliminar el campo de fecha del array de datos
      unset($input['fecha']);

      // Crear el nuevo registro en la base de datos
      Days::create($input);

      return redirect('days')->with('flash_message', 'Día Añadido!');
  }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $days = Days::find($id);
        return view('days.edit')->with('days', $days);
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
        $days = Days::find($id);
        $input = $request->all();
        $days->update($input);
        return redirect('days')->with('flash_message', 'day Updated!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        days::destroy($id);
        return redirect('days')->with('flash_message', 'day deleted!');
    }
}
