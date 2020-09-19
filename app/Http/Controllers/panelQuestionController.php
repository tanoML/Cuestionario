<?php

namespace App\Http\Controllers;

use App\question;
use App\topic;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class panelQuestionController extends Controller
{
    //
    public function index($slug)
    {
        //$tem = topic::select('id')->where('slug',$slug)->firstOrFail();
        //this is from a scope
        $idT = topic::IdFromtopic($slug)->firstorFail()->id;
       //dd($idT);
       //save the current id of the topic
       session(['idToActualTopic' => $idT]);
       //also need a count var for know the position of the question
       session(['contadorPreg' => 0]);
       session(['contadorPregFlag' => 0]);
       //only send the slug
       return view('optionToQuestion',['slug' => $slug]);
    }

    public function opSecuencial($slug)
    {
        //$preg = question::where('id_temas',session('idToActualTopic'))->get();
        $preg = DB::table('questions')->select('id','pregunta','respuesta')->where('id_temas',session('idToActualTopic'))->offset(session('contadorPreg'))->limit(1)->first();
        //we need to save the current answer
        session(['answerCurr' => $preg->respuesta]);
        //dd($preg->respuesta);
        //$pregu = '';
        if(session('contadorPreg') == session('contadorPregFlag'))
        {
            //here we can get all the ids for the answer withouth the original questions
            $idsResp = question::Geidrandomanswer($preg->id, session('idToActualTopic'))->get();
            //we need a array for save all ids
            $ids = [];
            //iterate the collectionj idsResp and save to ids
            foreach ($idsResp as $key => $item)
            {
                $ids[$key] = $item->id; 
            }
            //next we need to add the actual resp of orig question
            $ids = Arr::add($ids, '4' , $preg->id);
            //now we need to sort the elements
            //$ids = Arr::shuffle($ids);
            //dd($ids);
            //finally get only the answer by ids
            $respEnd = question::select('respuesta')->find($ids)->shuffle();
            //we nees to save the finally answer
            session(['copyAnswer' => $respEnd]);
        }else
        {
            //this is when back to server for check
            $respEnd = session('copyAnswer');
        }
        //dd($ids);
        //dd($respPro);
        return view('panelQuestions',[
            'slug' => $slug,
            'pregunta' => $preg->pregunta,
            'respuestas' => $respEnd,
            'respuestaOrig' => $preg->respuesta,
            ]);
    }

    public function checkAnswer(Request $request, $slug)
    {
        if(session('answerCurr') === $request->respuesta)
        {
            session(['contadorPregFlag' => -1]);
            return redirect()->route('pSecuencial',$slug)->with('messagesCorrect','Respuesta Correcta, por favor continue');
        }else
        {
            session(['contadorPregFlag' => -1]);
            session(['answerIncorrect' => ($request->respuesta)]);

            return redirect()->route('pSecuencial',$slug)->with('messagesWrong','Respuesta Incorrecta.');
        }
    }

    public function continueQuestion($slug)
    {
         session(['contadorPreg' => (session('contadorPreg') + 1)]);
         session(['contadorPregFlag' => (session('contadorPreg'))]);
         return redirect()->route('pSecuencial',$slug);
    }

}
