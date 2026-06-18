<?php

namespace App\Http\Controllers;

use App\Factories\FileFactory;
use App\Helpers\Logit;
use App\Http\Requests\UploadFileRequest;
use Exception;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function upload(UploadFileRequest $request)
    {
        $fileFactory = new FileFactory(
            $request->validated('entity_type'),
            $request->validated('entity_id'),
            $request->validated('file'),
        );

        return $fileFactory->getInstance()
            ->upload()
            ->finalize()
            ->getEntity();
    }

    public function replace(UploadFileRequest $request)
    {
        $fileFactory = new FileFactory(
            $request->validated('entity_type'),
            $request->validated('entity_id'),
            $request->validated('file'),
        );

        return $fileFactory->getInstance()
            ->replace()
            ->finalize()
            ->getEntity();
    }

    /**
     * @param Request $request
     */
    public function delete(UploadFileRequest $request)
    {
        $fileFactory = new FileFactory(
            $request->validated('entity_type'),
            $request->validated('entity_id'),
            $request->validated('file'),
        );

        return $fileFactory->getInstance()
            ->delete()
            ->finalize()
            ->getEntity();
    }
}
