<?php

namespace App\Abstracts;

use App\Contracts\CloudFileServiceContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

abstract class AbstractFileManager
{
    protected string $subPath;
    protected string $imageUrl;
    protected int $tenantId;
    protected bool $deleteFromCloud = false;

    protected string $fileSystemDisk = 's3';

    public function __construct(
        protected Model $entity,
        protected UploadedFile|string $file
    ) {
        $this->tenantId = Auth::user()->staff()->first()->tenant_id;
        $this->setSubPath();
    }

    /**
     * @var CloudFileServiceContract
     */
    protected CloudFileServiceContract $cloudService;

    abstract public function finalize(): AbstractFileManager;

    abstract protected function upload();

    abstract protected function delete();

    abstract protected function replace();
    abstract protected function setSubPath(): void;

    public function getCloudService(): CloudFileServiceContract
    {
        return $this->cloudService;
    }

    public function getEntity(): Model
    {
        return $this->entity;
    }
}
