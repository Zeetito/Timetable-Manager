<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\ProgramStream;
use App\Http\Controllers\Controller;

class ProgramStreamController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(ProgramStream::all());
    }

    public function show(Request $request, ProgramStream $programStream)
    {
        return response()->json($programStream);
    }
}
