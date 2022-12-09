<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    private $seriesRepository;

    public function __construct ( SeriesRepository $seriesRepository)
    {
        $this->seriesRepository = $seriesRepository;
    }

    public function index(Request $request)
    {
        $query = Series::query();
        if($request->has('nome')){
            $query->where('nome', $request->nome);
        }

        return $query->paginate(4);
    }

    public function store(SeriesFormRequest $request)
    {
        return response()->json($this->seriesRepository->add($request), 201);
    }
    
    /**
     * show
     *
     * @param  int $series
     * @return Series
     */
    public function show ( int $series)
    {
        // Também pode ser feito asim
        // $seriesModel = Series::with('seasons.episodes')->find($series);

        if (Series::find($series)) {
            return Series::find($series);
        }

        return response()->json(
            [
                "mensagem" =>'Série não encontrada',
                "status" => 400
            ], 404);
    }

    // caso queira trazer com os relacionamentos
    // public function show ( int $series)
    // {
    //     $serie = Series::whereId($series)->with('seasons.episodes')->first();
    //     return $serie;
    // }
    
    /**
     * update
     *
     * @param  Series $series
     * @param  SeriesFormRequest $request
     * @return Series
     */
    public function update (Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();

        return $series;
    }
    
    /**
     * destroy
     *
     * @param  int $series
     * @return Response
     */
    public function destroy (int $series)
    {
        Series::destroy($series);
        return response('Série excluida com sucesso',200);
    }
}