<?php

namespace KetoBootstrap\Http\Controllers;

use Illuminate\Http\Request;
use KetoBootstrap\Instruction;
use KetoBootstrap\Recipe;

class InstructionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $recipes = Recipe::orderBy('id', 'DESC')->get();

        return view('instruction.create', compact('recipes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $instruction = Instruction::create([
            'recipe_id' => $request->recipe,
            'description' => $request->description
        ]);

        $recipe = Recipe::find($request->recipe);

        return redirect('recipe/'.$recipe->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $instruction = Instruction::find($id);

        $recipes = Recipe::orderBy('id', 'DESC')->get();

        return view('instruction.edit', compact('instruction', 'recipes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $instruction = Instruction::find($id);

        $instruction->recipe_id = $request->recipe;
        $instruction->description = $request->description;

        $instruction->save();

        $recipe = Recipe::find($request->recipe);

        return redirect('recipe/'.$recipe->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $instruction = Instruction::find($id);

        $recipe = Recipe::find($instruction->recipe_id);

        $instruction->delete();  

        return redirect('recipe/'.$recipe->slug);
    }
}
