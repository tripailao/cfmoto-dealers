<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $file_path)
    {
        abort_if(
            ! Storage::disk('hidden') ->exists($file_path),
            404,
            "The file doesn't exist. Check the path."
        );

        return Storage::disk('hidden')->response($file_path);
    }
}
