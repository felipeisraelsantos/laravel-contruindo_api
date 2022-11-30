<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;

class EpisodesController
{
    public function index ( Season $season)
    {
        return view('episodes.index', [
            'episodes' => $season->episodes,
            'msgSuccess' => session('mensagem.sucesso')
        ]);
    }

    public function update ( Season $season, Request $request)
    {


        $watchedEpisodes = $request->episodes;

        $season->episodes->each(function ( Episode $episode ) use ($watchedEpisodes) {
            $episode->watched =  in_array($episode->id, $watchedEpisodes);
        } );
        $season->push();

        return view('episodes.index', ['episodes' => $season->episodes])
            ->with('msgSuccess', 'Episódios Assistidos');
    }
}