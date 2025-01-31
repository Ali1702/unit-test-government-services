<?php

namespace App\Http\Controllers;

use App\Http\Requests\LicenseRequest;
use App\Http\Requests\UpdateLicenseRequest;
use App\Models\Citizen;
use App\Models\License;

class LicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Citizen $citizen)
    {
        return response()->json($citizen->licenses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Citizen $citizen, LicenseRequest $request)
    {
        $license = $citizen->licenses()->create($request->validated());

        return response()->json($license, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Citizen $citizen, License $license)
    {
        return response()->json($license);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Citizen $citizen, LicenseRequest $request, License $license)
    {
        $license->update($request->validated());

        return response()->json($license);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Citizen $citizen, License $license)
    {
        $license->delete();

        return response()->json(null, 204);
    }
}
