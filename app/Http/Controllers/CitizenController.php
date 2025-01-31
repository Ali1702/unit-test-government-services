<?php

namespace App\Http\Controllers;

use App\Http\Requests\CitizenRequest;
use App\Http\Requests\UpdateCitizenRequest;
use App\Models\Citizen;

class CitizenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Citizen::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CitizenRequest $request)
    {
        $citizen = Citizen::create($request->validated());

        return response()->json($citizen, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Citizen $citizen)
    {
        return response()->json($citizen);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CitizenRequest $request, Citizen $citizen)
    {
        $citizen->update($request->validated());

        return response()->json($citizen);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Citizen $citizen)
    {
        $citizen->delete();

        return response()->json(null, 204);
    }
}
