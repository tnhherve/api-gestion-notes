<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ApiCoursController extends Controller
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
        $cours = Cours::all();

        return response()->json([
            'status' => true,
            'data' => $cours
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
            'section_id' => 'required',
            'nom_cours' => 'required|string',
            'seuil_reussite' => 'numeric',
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'=>false,
                'message'=> $validator->errors()
            ]);
        } 

        $cours = new Cours();
        $cours->section_id = $request->section_id;
        $cours->nom_cours = $request->nom_cours;
        $cours->seuil_reussite = $request->seuil_reussite;
        $cours->user_id = $request->user_id;

        if ($cours->save()) {
            return response()->json([
                'status' => true,
                'data' => $cours
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Oops! the cours could not be saved.'
            ]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cours  $cours
     * @return \Illuminate\Http\Response
     */
    public function show(int $cour)
    {
        return response()->json([
            'status' => true,
            'data' => Cours::find($cour)
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cours  $cours
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $cour)
    {
        $validator = Validator::make($request->all(),[
            'section_id' => 'required',
            'nom_cours' => 'required|string',
            'seuil_reussite' => 'numeric|max:80',
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'=>false,
                'message'=> $validator->errors()
            ]);
        } 
        $cours = Cours::find($cour);
        $cours->section_id = $request->section_id;
        $cours->nom_cours = $request->nom_cours;
        $cours->seuil_reussite = $request->seuil_reussite;
        $cours->user_id = $request->user_id;

        if ($cours->save()) {
            return response()->json([
                'status' => true,
                'data' => $cours
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Oops! the cours could not be updated.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cours  $cours
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $cour)
    {
        $cours = Cours::find($cour);
        if ($cours->delete()) {
            return response()->json([
                'status' => true,
                'data' => $cours
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Oops! the cours could not be updated.'
            ]);
        }
        
    }

    public function getEvaluations(Cours $cours)
    {
        $evaluation = $cours->evaluations()->get();

        return response()->json([
            'status' => true,
            'cours' => $cours,
            'evaluations' => $evaluation
        ]);
    }

}
