<?php

namespace App\Contracts;

use Illuminate\Http\UploadedFile;

interface CloudFileServiceContract
{
    /**
     * @return CloudFileServiceContract
     */
    public function upload();

    /**
     * @param int $tenantId
     * @return CloudFileServiceContract
     */
    public function setTenantId(int $tenantId);

    /**
     * @param string $subPath
     * @return CloudFileServiceContract
     */
    public function setSubPath(string $subPath);

    /**
     * @param UploadedFile $file
     * @return CloudFileServiceContract
     */
    public function setFile(UploadedFile $file);

    /**
     * @return string
     */
    public function getCloudFilePath();

    /**
     * @return bool
     */
    public function isSuccess();

    /**
     * @return CloudFileServiceContract
     */
    public function delete();

    /**
     * @return string
     */
    public function getPreSignedUrl();
}
