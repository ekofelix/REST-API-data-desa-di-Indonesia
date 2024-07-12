<?php

namespace App\Http\Controllers;

use App\Models\Regency;
use Illuminate\Http\Request;

class RegenciesController extends Controller
{
    public function index()
    {
        $regencies = Regency::all();

        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'data' => $regencies,
        ], 200);
    }

    public function show($id)
    {
        try {
            $regency = Regency::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Data retrieved successfully',
                'data' => $regency,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Regency not found',
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|string|max:4|unique:regencies',
            'province_id' => 'required|string|max:2',
            'name' => 'required|string|max:255',
        ]);

        try {
            $regency = Regency::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Regency created successfully',
                'data' => $regency,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create regency',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $regency = Regency::findOrFail($id);
            $regency->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Regency updated successfully',
                'data' => $regency,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update regency',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $regency = Regency::findOrFail($id);
            $regency->delete();

            return response()->json([
                'success' => true,
                'message' => 'Regency deleted successfully',
                'data' => $regency,
            ], 204);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete regency',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
