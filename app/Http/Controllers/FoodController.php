<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Food;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods = Food::latest()->paginate(5);
        return view('food.index', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('food.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|integer',
            'description' => 'required',
            'category' => 'required',
            'image' => 'required|mimes:png,jpeg,jpg',
        ]);
        $name = $request->get('name');
        $image = $request->file('image');
        $img_name = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $img_name);

        Food::create([
            'name' => $name,
            'description' => $request->get('description'),
            'category_id' => $request->get('category'),
            'price' => $request->get('price'),
            'image' => $img_name,
        ]);

        return redirect()->route('food.index')->with('message', "Food $name created");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $food = Food::find($id);
        return view('food.edit', compact('food'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|integer',
            'description' => 'required',
            'category' => 'required',
            'image' => 'mimes:png,jpeg,jpg',
        ]);

        $food = Food::find($id);
        $img_name = $food->image;
        $name = $request->get('name');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $img_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $img_name);
        }

        $food->name = $name;
        $food->description = $request->get('description');
        $food->category_id = $request->get('category');
        $food->price = $request->get('price');
        $food->image = $img_name;
        $food->save();

        return redirect()->route('food.index')->with('message', "Food $name was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $food = Food::find($id);
        $name = $food->name;
        $food->delete();

        return redirect()->route('food.index')->with('message', "Food $name was deleted");
    }
}
