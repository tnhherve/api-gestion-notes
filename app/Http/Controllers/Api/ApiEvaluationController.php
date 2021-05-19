<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use App\Models\Cours;
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
            'cours_id' => 'required',
            'titre' => 'required|string',
            'note' => 'required|numeric|max:100',
            'date_evaluation' => 'required',
            'ponderation'=> 'required|numeric|max:100',
            'type_evaluation' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'=>false,
                'message'=> $validator->errors()
            ]);
        } 

        $eval = Evaluation::find($request->cours_id);
        
        $sum_ponderation = 0;
        
        if ($val != null)
        {
            $sum = $eval->sum('ponderation');
            
            if ($sum >= 100) {
                return response()->json([
                    'status'=>false,
                    'message'=> "ponderation deja egal a 100"
                ]);
            } else if ($request->ponderation > (100-$sum)) {
                return response()->json([
                    'status'=>false,
                    'message'=> "ponderation doit etre inferieur a".(100-$sum)
                ]);
            }
            
        }


        $evaluation = new Evaluation();
        $evaluation->cours_id = $request->cours_id;
        $evaluation->titre = $request->titre;
        $evaluation->note = $request->note;
        $evaluation->date_evaluation = $request->date_evaluation;
        $evaluation->ponderation = $request->ponderation;
        $evaluation->type_evaluation = $request->type_evaluation;

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
            'cours_id' => 'required|string',
            'titre' => 'required|string',
            'note' => 'required|numeric|max:100',
            'date_evaluation' => 'required',
            'ponderation'=> 'required|numeric|max:90',
            'type_evaluation' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'=>false,
                'message'=> $validator->errors()
            ]);
        } 

        $eval = Evaluation::find($request->cours_id);
        
        $sum_ponderation = 0;
        
        if ($val != null)
        {
            $sum = $eval->sum('ponderation');
            
            if ($sum >= 100) {
                return response()->json([
                    'status'=>false,
                    'message'=> "ponderation deja egal a 100"
                ]);
            } else if ($request->ponderation > (100-$sum)) {
                return response()->json([
                    'status'=>false,
                    'message'=> "ponderation doit etre inferieur a".(100-$sum)
                ]);
            }
            
        }

        $evaluation->cours_id = $request->cours_id;
        $evaluation->titre = $request->titre;
        $evaluation->note = $request->note;
        $evaluation->date_evaluation = $request->date_evaluation;
        $evaluation->ponderation = $request->ponderation;
        $evaluation->type_evaluation = $request->type_evaluation;

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
