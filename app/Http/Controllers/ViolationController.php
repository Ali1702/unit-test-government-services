<?php

namespace App\Http\Controllers;

use App\Http\Requests\ViolationRequest;
use App\Models\Citizen;
use App\Models\License;
use App\Models\Violation;

class ViolationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Citizen $citizen, License $license)
    {
        return response()->json($license->violations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Citizen $citizen, License $license, ViolationRequest $request)
    {
        $violation = $license->violations()->create($request->validated());

        return response()->json($violation, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Citizen $citizen, License $license, Violation $violation)
    {
        return response()->json($violation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Citizen $citizen, License $license, ViolationRequest $request, Violation $violation)
    {
        $violation->update($request->validated());

        return response()->json($violation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Citizen $citizen, License $license, Violation $violation)
    {
        $violation->delete();

        return response()->json(null, 204);
    }
}
