<?php

namespace App\Http\Controllers;

use App\Peliculas;
use App\User;
use App\Comentarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeliculasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peliculas = Peliculas::all();
        return response($peliculas)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pelicula = Peliculas::create($request->all());
        return response()->json(['success'=> true, 'pelicula'=>$pelicula], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request ,$id)
    {   $pelicula = Peliculas::where('id', $id)->first();
        return response()->json(['success'=> true, 'peliculas'=>$pelicula], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Peliculas  $peliculas
     * @return \Illuminate\Http\Response
     */
    public function edit(Peliculas $peliculas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Peliculas  $peliculas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peliculas $peliculas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Peliculas  $peliculas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peliculas $peliculas)
    {
        //
    }

    public function showComments(Request $request)
    {
        $users =DB::table('comentarios')
        ->join('users', 'comentarios.users_id', '=', 'users.id')
        ->select('comentarios.contenido', 'users.email as nombre', 'users.created_at as fecha')
        ->where('comentarios.peliculas_id', '=', $request->input('pelicula_id'))
        ->get();
        return response()->json(['success'=> true, 'comentarios'=>$users], 200);
    }

    public function addComment(Request $request)
    {
        DB::table('comentarios')->insert([
            'contenido' => $request->input('contenido'),
            'users_id' => $request->input('users_id'),
            'peliculas_id' => $request->input('peliculas_id'),
        ]);
        return response()->json(['success'=> true], 200);
    }

    public function updateLike(Request $request ,$id)
    {   $pelicula = Peliculas::findOrFail($id);
        $pelicula->likes =  $pelicula->likes+1;
        $pelicula->save();

        return response()->json(['success'=> true], 200);
    }

    public function getTop(Request $request)
    {
        $top=DB::table('peliculas')
        ->select('peliculas.title as categories', 'peliculas.likes as series')
        ->get();
        return response()->json(['success'=> true, 'top'=>$top], 200);
    }
}
