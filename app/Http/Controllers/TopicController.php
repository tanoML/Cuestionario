<?php

namespace App\Http\Controllers;

use App\topic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $all = topic::paginate(5);

        return view('principalTopic',[
            'topics' => $all,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('addTopic');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if(topic::where('tema',$request->topics)->exists())
        {
            return redirect()->route('topics.index')
            ->with('messages', 'el tema ya se encuentra registrado en el sistema por favor vuelva ha ingresar otro tema.');
        }else
        {


            $newT = new topic();
            $newT->tema = strtolower($request->topics);
            $newT->slug = Str::slug($request->topics,'-');
            $newT->save();
    
            return redirect()->route('topics.index')->with('messages','el tema ha sido registrado de forma correcta.');

        }

      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(topic $topic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(topic $topic)
    {
        //
        //dd($topic);
        return view('editTopic',[
            'tema' => $topic,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, topic $topic)
    {
        //
        //dd($topic);
        //dd($request);
        //$topicUpd = $topic::find($topic->id);
        //$topicUpd->tema = $request->topicNew;
        //$topicUpd->slug = Str::slug($request->topicNew,'-');
        //$topicUpd->save();
        $topic->tema = $request->topicNew;
        $topic->slug = Str::slug($request->topicNew,'-');
        $topic->save();
        return redirect()->route('topics.index')->with('messages','El tema ha sido actualizado de forma correcta.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(topic $topic)
    {
        //
        $topic::destroy($topic->id);

        return redirect()->route('topics.index')->with('messages', 'El tema ha sido eliminado de forma correcta');
    }
}
