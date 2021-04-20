<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TypeEvaluation;

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
        return $typeEvaluation->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ecole = TypeEvaluation::create($request->all());
        return $typeEvaluation->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeEvaluation  $typeEvaluation
     * @return \Illuminate\Http\Response
     */
    public function show(TypeEvaluation $typeEvaluation)
    {
        return $typeEvaluation->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeEvaluation  $typeEvaluation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $typeEvaluation)
    {
        $typeEval = TypeEvaluation::find($typeEvaluation);
        $typeEval->update($request->all());

        return $typeEval->toJson();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeEvaluation  $typeEvaluation
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeEvaluation $typeEvaluation)
    {
        $typeEval = EcolTypeEvaluatione::find($typeEvaluation);
        $typeEval->delete();

        return "success";
    }
}
