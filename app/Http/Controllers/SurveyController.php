<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surveys = Survey::with(['createdBy'])->get();

        return view('panel.dashboard.surveys', compact('surveys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'url' => 'required|url|unique:surveys',
            'published_date' => 'required|date'
        ])) {
            // Store the survey info

            try {
                $survey = new Survey($request->all());
                $survey->createdBy()->associate(Auth::user());

                $survey->save();
                return response("Encuesta guardada exitosamente", 200);
            } catch (Exception $err) {
                return response($err->getMessage(), 500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function edit(Survey $survey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'url' => 'required|url',
            'published_date' => 'required|date'
        ])) {
            // Store the survey info

            try {
                $survey = Survey::find($id);
                $survey->update($request->all());
                $survey->createdBy()->associate(Auth::user());

                $survey->save();
                return response("Encuesta guardada exitosamente", 200);
            } catch (Exception $err) {
                return response($err->getMessage(), 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $survey = Survey::find($id);
            $survey->delete();
            return response('Encuesta eliminada', 200);
        } catch (Exception $err) {
            return response($err->getMessage(), 500);
        }
    }

    /**
     * Get all surveys.
     *
     * @param  integer  $id
     * @return \App\Models\Survey
     */
    public function getSurveysList()
    {
        return Survey::all();
    }
}
