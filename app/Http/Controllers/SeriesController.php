<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        $series = Series::with(['seasons'])->get();

        $msgSuccess = $request->session()->get('mensagem.sucesso');

        return view('series.index')
            ->with('series', $series)
            ->with('msgSuccess', $msgSuccess);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('series.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeriesFormRequest $request)
    {

       $serie = Series::create($request->all());
       $seasons = [];

       for ($i=1; $i <= $request->seasonsQty ; $i++) { 
            $seasons[] = [
                'series_id' => $serie->id,
                'number' => $i
            ];
       }

       Season::insert($seasons);

       $episodes = [];
       foreach ($serie->seasons as $season) {
            for ($i=1; $i <=$request->episodesPerSeason; $i++) { 
                $episodes[] = [
                    'season_id' => $season->id,
                    'number' => $i
                ];
            }
       }
       Episode::insert($episodes);

       $request->session()->flash('mensagem.sucesso', "Série {$serie->nome} adicionada com sucesso");

       return redirect()->route('series.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Series $series)
    {
        return view('series.edit')->with('serie', $series);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeriesFormRequest $request, Series $series)
    {
        $series->fill($request->all());
        $series->save();

        return redirect()->route('series.index')
            ->with('mensagem.sucesso', "Série {$series->nome} atualizada com sucesso");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Series $series)
    {
        $series->delete();

        return redirect()->route('series.index')
            ->with('mensagem.sucesso', "Série {$series->nome} removida com sucesso");
    }
}
