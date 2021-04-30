<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TypeEvaluation;
use Illuminate\Support\Facades\Validator;

class TypeEvaluationController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeEvaluation = TypeEvaluation::all();
        return response()->json([
            'status' => true,
            'TypeEvaluations' => $typeEvaluation
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
            'nom_type' => 'required|string',
            'ponderation' => 'required|numeric',
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'status'=> false,
                'message' => $validator->errors()
            ], 400);
        }

        $typeEvaluation = TypeEvaluation::create($request->all());
        
        if ($typeEvaluation) {
            return response()->json([
                'status' => true,
                'data' => $typeEvaluation
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Oops! the typeEvaluation could not be updated.'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeEvaluation  $typeEvaluation
     * @return \Illuminate\Http\Response
     */
    public function show(TypeEvaluation $typeEvaluation)
    {
        return response()->json([
            'status' => true,
            'typeEvaluations' => $typeEvaluation
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeEvaluation  $typeEvaluation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeEvaluation $typeEvaluation)
    {
        $validator = Validator::make($request->all(),[
            'nom_type' => 'required|string',
            'ponderation' => 'required|numeric',
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'status'=> false,
                'message' => $validator->errors()
            ], 400);
        }

        $typeEvaluation->nom_type = $request->nom_type;
        $typeEvaluation->ponderation = $request->ponderation;
        
        if ($typeEvaluation->save()) {
            return response()->json([
                'status' => true,
                'data' => $typeEvaluation
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Oops! the typeEvaluation could not be updated.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeEvaluation  $typeEvaluation
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeEvaluation $typeEvaluation)
    {
        if ($typeEvaluation->delete()) {
            return response()->json([
                'status' => true,
                'data' => $typeEvaluation
            ]);
        }
        else{
            return response()->json([
                'status' => false,
                'message' => 'Oops! the typeEvaluation could not be deleted.'
            ]);
        }
    }

    public function getEvaluations(TypeEvaluation $typeEvaluation)
    {
        $evaluation = $typeEvaluation->evaluations()->get();
        $taille = count($evaluation);
        $sommeNote = $evaluation->sum('note');
        return response()->json([
            'status' => true,
            'typeEvaluation' => $typeEvaluation,
            'evaluations' => $evaluation,
            'length' => $taille,
            'note_total' => $sommeNote,
            'note_moyenne' => $sommeNote/$taille
            
        ]);
    }
}
