<?php

namespace App\Http\Controllers;

use App\Models\Village;
use Illuminate\Http\Request;

class VillagesController extends Controller
{
    public function index()
    {
        $villages = Village::paginate(1000);

        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'data' => $villages,
        ], 200);
    }

    public function show($id)
    {
        try {
            $village = Village::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Data retrieved successfully',
                'data' => $village,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Village not found',
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|string|max:10|unique:villages',
            'district_id' => 'required|string|max:7',
            'name' => 'required|string|max:255',
        ]);

        try {
            $village = Village::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Village created successfully',
                'data' => $village,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create village',
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
            $village = Village::findOrFail($id);
            $village->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Village updated successfully',
                'data' => $village,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update village',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $village = Village::findOrFail($id);
            $village->delete();

            return response()->json([
                'success' => true,
                'message' => 'Village deleted successfully',
                'data' => $village,
            ], 204);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete village',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
