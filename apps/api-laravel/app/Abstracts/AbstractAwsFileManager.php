<?php

namespace App\Abstracts;

use App\Services\AwsFileService;

abstract class AbstractAwsFileManager extends AbstractFileManager
{
    public function upload(): AbstractFileManager
    {
        if (empty($this->file)) {
            throw new \Exception('File cannot be empty for aws upload');
        }

        // upload user image
        $this->cloudService = (new AwsFileService())
            ->setTenantId($this->tenantId)
            ->setFile($this->file)
            ->setSubPath($this->subPath)
            ->upload();

        return $this;
    }

    /**
     * @throws \Exception
     */
    public function replace(): AbstractFileManager
    {
        if (empty($this->file)) {
            throw new \Exception('File cannot be empty for aws upload');
        }

        // first delete current file on aws
        $this->delete();
        $this->upload();

        return $this;
    }

    public function delete(): AbstractFileManager
    {
        if (false === $this->deleteFromCloud) {
            return $this;
        }

        $this->cloudService = (new AwsFileService($this->fileSystemDisk))
            ->setUrl($this->imageUrl)
            ->delete();

        return $this;
    }
}
