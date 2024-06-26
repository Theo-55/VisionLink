<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Point;
use App\Http\Requests\PointRequest;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Inertia::render('Points/Index',[
            'points' => Point::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return Inertia::render('Points/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PointRequest $request)
    {
        //
        try{
            Point::create([
                'name' => $request->name,
                'x_val' => $request->x_val,
                'y_val' => $request->y_val,
            ]);
            return response()->json(['Point Created']);
        } catch (Throwable $e) {
            return response()->json(['Errro Submitting Request', $e]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

            $point = Point::find($id);
            $otherPoints = Point::where('id', '!=', $id)->get();

            return Inertia::render('Points/Show',[
                'currentPoint' => $point,
                'otherPoints' => $otherPoints
            ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'x_val' => 'required',
            'y_val' => 'required',
        ]);

        $point = Point::find($request->id);

        $point->name = $request->input('name');
        $point->x_val = $request->input('x_val');
        $point->y_val = $request->input('y_val');

        $point->save();

        return response()->json([
            'message' => 'Point updated successfully!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try{
            $point = Point::find($id);
            $point->delete();
            return response()->json(['Point Deleted']);
        }catch (Throwable $e) {
            return response()->json(['Errro Deleting Point', $e]);
        }
    }
}
