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

    public function configuration(
        FileRepository $fileRepository
    ) {
        $logoRecord = $fileRepository->getLogo();

        return view('dashboard.configuration', array(
            'logo' => $logoRecord
        ));
    }

    public function configurationStore(
        Request $request,
        FileRepository $fileRepository
    ) {
        if($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = $file->store('files');

            $logoRecord = $fileRepository->getLogo();
            $data = array(
                'filename'              => $path,
                'filename_original'     => $file->getClientOriginalName(),
                'extension'             => $file->extension(),
                'mime'                  => $file->getClientMimeType(),
                'size'                  => $file->getSize(),
                'md5'                   => md5_file($file->getRealPath()),
            );

            if($logoRecord) {
                Storage::delete($logoRecord->filename);
                $logoRecord->update($data);
            } else {
                $fileRepository->create(array_merge($data, array(
                    'relation'              => 'logo',
                    'foreign_id'            => null
                )));
            }
        }

        $logoRecord = $fileRepository->getLogo();

        return view('dashboard.configuration', array(
            'logo' => $logoRecord
        ));
    }
}
