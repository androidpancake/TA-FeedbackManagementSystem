<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResponseRequest;
use App\Models\AdditionalResponse;
use App\Models\Response;
use App\Models\Survey;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    public function index(){

        $user = Auth::user();

        $classes = $user->class->pluck('id');

        $surveys = Survey::with([
            'class', 'responses'
        ])->whereIn('kelas_id', $classes)->get();
        
        
        foreach($surveys as $survey){
            $existingResponse = Response::where('survey_id', $survey->id)->where('user_id', $user->id)->first();

            $survey->hasFilled = $existingResponse ? true : false;

            $startTime = Carbon::parse($survey->date);
            $diffTime = $startTime->diffForHumans(Carbon::now());
        }

        return view('mahasiswa.survey.index', [
            'surveys' => $surveys,
            // 'diff' => $diffTime
        ]);

    }
    public function fill_survey($id)
    {
        $user = auth()->user();

        $survey = Survey::findOrFail($id);

        $reason1to3 = AdditionalResponse::where('for', 'low')->get();
        $reason4to5 = AdditionalResponse::where('for','high')->get();

        $existingResponse = Response::where('survey_id', $survey->id)->where('user_id', $user->id)->first();

        $hasFilled = $existingResponse ? true : false;
        
        if(now() > $survey->limit_date){
            return redirect()->back()->with('error', 'waktu sudah habis');
        } else {
            return view('mahasiswa.survey.fill', [
                'survey' => $survey,
                'hasFilled' => $hasFilled,
                'reasonLow' => $reason1to3,
                'reasonHigh' => $reason4to5
            ]);
        }
    }


    public function fill(ResponseRequest $request, $id)
    {

        $survey = Survey::findOrFail($id);

        $data = $request->all();

        if(isset($data['additional'])){
            $formatted = implode(',', $data['additional']);
            $data['additional'] = $formatted;
        }

        $data['survey_id'] = $survey->id;
        $data['user_id'] = auth()->id();

        Response::create($data);

        return redirect()->route('mahasiswa.survey.index');
        
    }
}
