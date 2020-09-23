<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::with(['answeredBy'])->get();

        return view('panel.dashboard.questions', compact('questions'));
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
            "asked_by" => "required|email",
            "question" => "required|min:5|max:300",
            "answer" => "sometimes|nullable",
            "sendResponseEmail" => "required|boolean"
        ])) {
            $values = $request->except(["answered_by", "sendResponseEmail"]);
            $question = new Question($values);

            try {

                if (isset($values['answer']) && ($values['answer'] != null || $values['answer'] != "")) {
                    $question->answeredBy()->associate(Auth::user());
                }

                $question->save();

                if ($request->input('sendResponseEmail')) {
                    // Send Email with answered question
                }

                return response("Gracias por participar. Responderemos a la brevedad posible", 200);
                
            } catch (Exception $err) {
                return response($err->getMessage(), 500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->validate([
            "asked_by" => "required|email",
            "question" => "required|min:5|max:300",
            "answer" => "nullable",
            "sendResponseEmail" => "required|boolean"
        ])) {
            $values = $request->except(["answered_by", "id", "sendResponseEmail"]);

            try {
                $question = Question::find($id);

                // Update values
                $question->question = $values['question'];
                $question->asked_by = $values['asked_by'];

                if ($values['answer'] != $question->answer) {
                    $question->answer = $values['answer'];
                    $question->answeredBy()->associate(Auth::user());
                }

                $question->save();

                if ($request->input('sendResponseEmail')) {
                    // Send Email with answered question
                }

                return response("Consulta actualizada", 200);
            } catch (Exception $err) {
                return response($err->getMessage(), 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Question::find($id)->delete();
            return response('Consulta eliminada', 200);
        } catch (Exception $err) {
            return response($err->getMessage(), 500);
        }
    }

    public function changeStatus(Request $request, $id)
    {
        if ($request->validate([
            'is_faq' => "required|boolean"
        ])) {
            Question::find($id)->update($request->all());
            return response($request->input('is_faq') ? "La pregunta fue agregada a la lista de preguntas frecuentes" : "La pregunta fue eliminada de la lista de preguntas frecuentes", 200);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFAQs()
    {
        $questions = Question::where(['is_faq' => true])->get();

        return $questions;
    }
}
