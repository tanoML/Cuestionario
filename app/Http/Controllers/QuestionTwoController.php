<?php

namespace App\Http\Controllers;

use App\question;
use App\topic;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionTwoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        //
        //dd($id);
        $val = topic::select('id')->where('slug',$slug)->firstOrFail();
         $question = question::where('id_temas',$val->id)->get();

        return view('principalQuestion',[
            'questions' => $question,
            'slug' => $slug,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        //
        //aqui podemos configurar el slug
        $val = topic::select('id')->where('slug',$slug)->firstOrFail();
        
        //dd($val->id);

        return view('addQuestion',[
            'topic' => $val->id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //

        //dd($request);

        $newQ = new question;
        $newQ->pregunta = strtolower($request->pregunta);
        $newQ->respuesta = strtolower($request->respuesta);
        $newQ->id_temas = $id;

        try {
            $newQ->save();
        } catch (QueryException $e) {
            //throw $th;
            dd($e);
        }
        

        $slug = DB::table('topics')->select('slug')->where('id',$id)->first();

        //dd($slug->slug);

        return redirect()->route('addQ',$slug->slug)
        ->with('messagesQ','la pregunta se ha agregado de forma correcta, por favor continue agregando mas o ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(question $question, $slug,$id)
    {

        //dd($slug);
        //
        //$uri = $request->fullUrl();
        //dd($uri);

        //dd($id);
        $question::destroy($id);

        return redirect()->route('principalQ', $slug)->with('messages','La pregunta ha sido eliminada de forma correcta');

    }
}
