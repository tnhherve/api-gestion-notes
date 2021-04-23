<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ecole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Resources\EcoleCollection;

class ApiEcoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ecole = Ecole::all();
        return response()->json([
            'status' => true,
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
        $validator = Validator::make($request->all(),[
            'nom_ecole' => 'required|string'
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'status'=> false,
                'message' => $validator->errors()
            ], 400);
        }

        $ecole = Ecole::create($request->all());

        return response()->json([
            'status' => true,
            'data' => $ecole
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ecole  $ecole
     * @return \Illuminate\Http\Response
     */
    public function show(Ecole $ecole)
    {
        
        return response()->json([
            'status' => true,
            'data' => $ecole
        ]);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ecole  $ecole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ecole $ecole)
    {
        $validator = Validator::make($request->all(),[
            'nom_ecole' => 'required|string'
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'status'=> false,
                'message' => $validator->errors()
            ], 400);
        }

        $ecole->nom_ecole = $request->nom_ecole;

        if ($ecole->save()) {
            return response()->json([
                'status' => true,
                'data' => $ecole
            ]);
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ecole  $ecole
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ecole $ecole)
    {
        if ($ecole->delete()) {
            return response()->json([
                'status' => true,
                'data' => $ecole
            ]);
        }
        else{
            return response()->json([
                'status' => false,
                'message' => 'Oops! the todo could not be deleted.'
            ]);
        }
       
    }

    
}
