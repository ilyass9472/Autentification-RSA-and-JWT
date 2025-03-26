<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hackathon;
use App\Models\Theme;
use App\Models\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class HackathonController extends Controller
{
    /**
     * Create a new hackathon
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'theme_id' => 'required|exists:themes,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'rules' => 'sometimes|array',
            'rules.*.name' => 'required_with:rules|string|max:255',
            'rules.*.description' => 'required_with:rules|string'
        ]);

        // Check validation
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            // Start database transaction
            DB::beginTransaction();

            // Create Hackathon
            $hackathon = Hackathon::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'theme_id' => $request->input('theme_id'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'organisateur_id' => auth()->id() // Assuming authenticated user is the organizer
            ]);

            // Handle Rules
            if ($request->has('rules')) {
                $rules = [];
                foreach ($request->input('rules') as $ruleData) {
                    $rules[] = new Rule([
                        'name' => $ruleData['name'],
                        'description' => $ruleData['description']
                    ]);
                }
                
                // Save rules associated with hackathon
                $hackathon->rules()->saveMany($rules);
            }

            // Commit transaction
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Hackathon créé avec succès',
                'hackathon' => $hackathon->load('theme', 'rules')
            ], 201);

        } catch (\Exception $e) {
            // Rollback transaction
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la création du hackathon',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get available themes
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getThemes()
    {
        $themes = Theme::all();
        
        return response()->json([
            'status' => 'success',
            'themes' => $themes
        ]);
    }
}