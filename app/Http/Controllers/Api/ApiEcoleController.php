<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ecole;
use Illuminate\Http\Request;

use App\Http\Resources\EcoleCollection;

class ApiEcoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ecole = Ecole::all();
        return response()->json([
            'status' => 'success',
            'data' => $ecole
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ecole = Ecole::create($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $ecole
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ecole  $ecole
     * @return \Illuminate\Http\Response
     */
    public function show(int $ecole)
    {
        $ecol = Ecole::find($ecole);
        if (!is_null($ecol)) {
            return response()->json([
                'status' => 'success',
                'data' => $ecol
            ]);
           
        } 
            return response()->json([
                'status' => 'error',
                'message' => 'id is not existe in database'
            ], 401);
        
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ecole  $ecole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $ecole)
    {
        $ecol = Ecole::find($ecole);
        $ecol->update($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $ecol
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ecole  $ecole
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ecole $ecole)
    {
        $ecol = Ecole::find($ecole);

    
        if (!is_null($ecol)) {
            
            $ecol->delete();

            return response()->json([
                'status' => 'success',
            ]);
           
        } 
            return response()->json([
                'status' => 'error',
                'message' => 'id is not existe in database'
            ]);

       
    }
}
