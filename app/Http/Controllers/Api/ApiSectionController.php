<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use Illuminate\Support\Facades\Validator;

class ApiSectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        // $this->user = $this->guard()->user();
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $section = Section::all();
        return response()->json([
            'status' => true,
            'data' => $section
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
            'nom_section' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'status'=> false,
                'message' => $validator->errors()
            ], 400);
        }

        $section = Section::create($request->all());

        if ($section) {
            return response()->json([
                'status' => true,
                'data' => $section
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Oops! the section could not be updated.'
            ]);
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        return response()->json([
            'status' => true,
            'data' => $section
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        $validator = Validator::make($request->all(),[
            'nom_section' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'status'=> false,
                'message' => $validator->errors()
            ], 400);
        }

        $section->nom_section = $request->nom_section;
        $section->date_debut = $request->date_debut;
        $section->date_fin = $request->date_fin;

        if ($section->save()) {
            return response()->json([
                'status' => true,
                'data' => $section
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Oops! the section could not be updated.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        if ($section->delete()) {
            return response()->json([
                'status' => true,
                'data' => $section
            ]);
        }
        else{
            return response()->json([
                'status' => false,
                'message' => 'Oops! the section could not be deleted.'
            ]);
        }
    }

    public function getCours(int $section)
    {
        $sections = Section::find($section);
        $cours = $sections->cours()->get();

        return response()->json([
            'status' => true,
            'section' => $sections,
            'cours' => $cours
        ]);
    }
}
