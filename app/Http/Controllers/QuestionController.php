<?php

namespace App\Http\Controllers;

use App\Question;
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
            "answer" => "nullable"
        ])) {
            $values = $request->except(["answered_by"]);
            $question = new Question($values);

            try {

                if ($values['answer'] != "" || $values['answer'] != null) {
                    $question->answeredBy()->associate(Auth::user());
                }
                $question->save();

                return response("Sent question. Thanks for asking", 200);
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
            "answer" => "nullable"
        ])) {
            $values = $request->except(["answered_by", "id"]);

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

                return response("Updated question.", 200);
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
    public function destroy(Question $question)
    {
        //
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
}
