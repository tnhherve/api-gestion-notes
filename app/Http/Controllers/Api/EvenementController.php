<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Evenement;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class EvenementController extends Controller
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
        $events = $this->user->evenements()->get();
        return response()->json([
            'status' => true,
            'length' => count($events),
            'data' => $events
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
        $validator = Validator::make($request->all(), [
            'nom_evenement' => 'required|string',
            'date_debut' => 'date',
            'date_fin' => 'date',
            'lieux' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'=>false,
                'message'=> $validator->errors()
            ]);
        }

        $event = new Evenement();
        $event->nom_evenement = $request->nom_evenement;
        $event->lieux = $request->lieux;
        $event->date_debut = $request->date_debut;
        $event->date_fin = $request->date_fin;

        if ($this->user->evenements()->save($event)) {
            return response()->json([
                'status' => true,
                'data' => $event
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Oops! the event could not be saved.'
            ]);
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evenement  $evenement
     * @return \Illuminate\Http\Response
     */
    public function show(Evenement $evenement)
    {
        return response()->json([
            'status' => true,
            'data' => $evenement
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evenement  $evenement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evenement $evenement)
    {
        $validator = Validator::make($request->all(), [
            'nom_evenement' => 'required|string',
            'date_debut' => 'date',
            'date_fin' => 'date',
            'lieux' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'=>false,
                'message'=> $validator->errors()
            ]);
        }

        $evenement->nom_evenement = $request->nom_evenement;
        $evenement->lieux = $request->lieux;
        $evenement->date_debut = $request->date_debut;
        $evenement->date_fin = $request->date_fin;

        if ($this->user->evenements()->save($evenement)) {
            return response()->json([
                'status' => true,
                'data' => $evenement
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Oops! the event could not be updated.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evenement  $evenement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evenement $evenement)
    {
        if ($evenement->delete()) {
            return response()->json([
                'status' => true,
                'data' => $evenement
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Oops! the event could not be deleted.'
            ]);
        }
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
