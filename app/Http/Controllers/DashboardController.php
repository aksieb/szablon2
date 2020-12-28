<?php

namespace App\Http\Controllers;

use App\Repositories\FileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{

    public function welcome()
    {
        return view('dashboard.welcome');
    }

    public function deleteFile(
        Request $request,
        FileRepository $fileRepository
    ) {
        $id = $request->input('id');
        $file = $fileRepository->find($id);

        Storage::delete($file->filename);

        $fileRepository->delete($id);

        return response()->json(array(
            'success'   => true
        ));
    }
}
