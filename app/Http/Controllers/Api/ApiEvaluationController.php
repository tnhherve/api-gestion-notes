<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ApiEvaluationController extends Controller
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
        $evaluation = Evaluation::all();

        return response()->json([
            'status' => true,
            'data' => $evaluation
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
            'type_evaluation_id' => 'required',
            'cours_id' => 'required|string',
            'titre' => 'required|string',
            'note' => 'required|numeric|max:100',
            'date_evaluation' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'=>false,
                'message'=> $validator->errors()
            ]);
        } 

        $evaluation = new Evaluation();
        $evaluation->type_evaluation_id = $request->type_evaluation_id;
        $evaluation->cours_id = $request->cours_id;
        $evaluation->titre = $request->titre;
        $evaluation->note = $request->note;
        $evaluation->date_evaluation = $request->date_evaluation;

        if ($evaluation->save()) {
            return response()->json([
                'status' => true,
                'data' => $evaluation
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Oops! the evaluation could not be saved.'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluation $evaluation)
    {
        return response()->json([
            'status' => true,
            'data' => $evaluation
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        $validator = Validator::make($request->all(),[
            'type_evaluation_id' => 'required',
            'cours_id' => 'required|string',
            'titre' => 'required|string',
            'note' => 'required|numeric|max:100',
            'date_evaluation' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'=>false,
                'message'=> $validator->errors()
            ]);
        } 

        
        $evaluation->type_evaluation_id = $request->type_evaluation_id;
        $evaluation->cours_id = $request->cours_id;
        $evaluation->titre = $request->titre;
        $evaluation->note = $request->note;
        $evaluation->date_evaluation = $request->date_evaluation;

        if ($evaluation->save()) {
            return response()->json([
                'status' => true,
                'data' => $evaluation
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Oops! the evaluation could not be saved.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluation $evaluation)
    {
        if ($evaluation->delete()) {
            return response()->json([
                'status' => true,
                'data' => $evaluation
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Oops! the evaluation could not be updated.'
            ]);
        }
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
