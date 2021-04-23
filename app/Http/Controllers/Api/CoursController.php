<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CoursController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->user = $this->guard()->user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cours = $this->user->cours()->get();

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
            'id_section' => 'required',
            'nom_cours' => 'required|string',
            'seuil_reussite' => 'numeric',
        ]);

        if ($validator->falis()) {
            return response()->json([
                'status'=>false,
                'message'=> $validator->errors()
            ]);
        } 

        $cours = new Cours();
        $cours->section_id = $request->section_id;
        $cours->nom_cours = $request->nom_cours;
        $cours->seuil_reussite = $request->seuil_reussite;

        if ($this->user->cours()->save($cours)) {
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
    public function show(Cours $cours)
    {
        return response()->json([
            'status' => true,
            'data' => $cours
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cours  $cours
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cours $cours)
    {
        $validator = Validator::make($request->all(),[
            'id_section' => 'required',
            'nom_cours' => 'required|string',
            'seuil_reussite' => 'numeric|max:80',
        ]);

        if ($validator->falis()) {
            return response()->json([
                'status'=>false,
                'message'=> $validator->errors()
            ]);
        } 

        $cours->section_id = $request->section_id;
        $cours->nom_cours = $request->nom_cours;
        $cours->seuil_reussite = $request->seuil_reussite;

        if ($this->user->cours()->save($cours)) {
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
    public function destroy(Cours $cours)
    {
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
            'data' => $evaluation
        ]);
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
