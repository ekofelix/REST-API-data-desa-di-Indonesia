<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictsController extends Controller
{
    public function index()
    {
        $districts = District::all();

        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'data' => $districts,
        ], 200);
    }

    public function show($id)
    {
        try {
            $district = District::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Data retrieved successfully',
                'data' => $district,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'District not found',
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|string|max:7|unique:districts',
            'regency_id' => 'required|string|max:4',
            'name' => 'required|string|max:255',
        ]);

        try {
            $district = District::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'District created successfully',
                'data' => $district,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create district',
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
            $district = District::findOrFail($id);
            $district->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'District updated successfully',
                'data' => $district,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update district',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $district = District::findOrFail($id);
            $district->delete();

            return response()->json([
                'success' => true,
                'message' => 'District deleted successfully',
                'data' => $district,
            ], 204);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete district',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
