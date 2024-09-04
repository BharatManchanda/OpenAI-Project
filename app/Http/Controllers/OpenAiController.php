<?php

namespace App\Http\Controllers;

use App\Services\OpenAiService;
use Illuminate\Http\Request;

class OpenAiController extends Controller
{
    //
    public function __construct()  {
        
    }

    public function getPrompt(Request $request) {
        try {
            $prompt = (new OpenAiService())->get($request->prompt);
            return response()->json([
                "status" => true,
                "data" => $prompt,
                "message" => "Prompt generated successfully."
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Prompt generated failed."
            ])->setStatus(403);
        }
    }
}
