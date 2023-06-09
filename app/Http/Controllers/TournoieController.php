<?php

namespace App\Http\Controllers;

use App\Models\Tournoie;
use App\Models\Participations;
use App\Models\Player;
use App\Models\Etab;
use App\Models\Sport;
use Illuminate\Http\Request;

class TournoieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tournoies = Tournoie::all();
        $participations = Participations::all();

        return view('SAdmin/Tournoie/Tournoie', compact('tournoies', 'participations') );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sports = Sport::all();
        return view('SAdmin/Tournoie/Create', compact('sports') ); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'desc' => ['required', 'string', 'max:1200'],
            'dateDebut' => ['required', 'string',],
        ]);
        
        $tournoie = new Tournoie;
        $tournoie->title = $request->input('title');
        $tournoie->desc = $request->input('desc');
        $tournoie->dateDebut = $request->input('dateDebut');
        $tournoie->dateFin = $request->input('dateFin');

        $size = $request->file('image')->getSize();
        $name = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/images/tournoies', $name);
        $tournoie->image = $name;

        $tournoie->save();
        return Redirect('/admin/tournoie');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tournoie = Tournoie::find($id);
        $participations = Participations::where('tournoie', $id)->get();

        return view('SAdmin/Tournoie/Details',['tournoie'=>$tournoie, 'participations'=>$participations]);
    }

    public function player(string $tournoiId, string $playerId)
    {
        $tournoie = Tournoie::find($tournoiId);
        $player = Player::find($playerId);
        // $players = Player::where('etab', Auth::user()->etab)->where('tournoie', $id)->get();

        return view('SAdmin/Tournoie/Player',['tournoie'=>$tournoie, 'player'=>$player]);
    }
    
    public function participation(string $tournoieId, string $etabid)
    {
        $tournoie = Tournoie::find($tournoieId);
        $etab = Etab::where('bref', $etabid)->get();
        $players = Player::where('tournoie', $tournoieId)->where('etab', $etabid)->get();

        return view('SAdmin/Tournoie/Participation', ['tournoie'=>$tournoie, 'etab'=>$etab, 'players'=>$players]);
    }
    
    
    public function deleteParticipation(string $tournoieId, string $etabid)
    {
        Participations::where('tournoie', $tournoieId)->where('etab', $etabid)->delete();
        Player::where('tournoie', $tournoieId)->where('etab', $etabid)->delete();
        return redirect(url('/admin/tournoie/'.$tournoieId));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tournoie = Tournoie::find($request->id);
        $tournoie->title = $request->title;
        $tournoie->desc = $request->desc;

        if($request->file('image')){
            $name = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/images/tournoies', $name);
            $tournoie->image = $name;
        }

        $tournoie->dateDebut = $request->dateDebut;
        $tournoie->dateFin = $request->dateFin;

        $result= $tournoie->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Tournoie::find($id)->delete();
        Participations::where('tournoie', $id)->delete();
        Player::where('tournoie', $id)->delete();

        return redirect('/admin/tournoie');
    }
}
