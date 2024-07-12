<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class ProvincesController extends Controller
{
    public function index()
    {
        $provinces = Province::all();

        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'data' => $provinces,
        ], 200);
    }

    public function show($id)
    {
        try {
            $province = Province::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Data retrieved successfully',
                'data' => $province,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Province not found',
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|string|max:2|unique:provinces',
            'name' => 'required|string|max:255',
        ]);

        try {
            $province = Province::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Province created successfully',
                'data' => $province,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create province',
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
            $province = Province::findOrFail($id);
            $province->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Province updated successfully',
                'data' => $province,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update province',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $province = Province::findOrFail($id);
            $province->delete();

            return response()->json([
                'success' => true,
                'message' => 'Province deleted successfully',
                'data' => $province,
            ], 204);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete province',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
