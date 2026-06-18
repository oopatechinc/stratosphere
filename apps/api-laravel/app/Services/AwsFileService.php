<?php
namespace App\Services;

use App\Contracts\CloudFileServiceContract;
use \Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class AwsFileService implements CloudFileServiceContract
{
    const BASE_PATH = '/tenants/';
    const STORAGE_TYPE_S3 = 's3';

    protected int $tenantId;
    protected string $subPath;
    protected string $url;
    protected string $uploadedFilePath;
    protected UploadedFile|string $file;
    protected bool $status = false;
    protected string $fileSystemDisk;

    public function __construct($fileSystemDisk = '')
    {
        //default file system to s3
        $this->fileSystemDisk = self::STORAGE_TYPE_S3;
        if ($fileSystemDisk) {
            $this->fileSystemDisk = $fileSystemDisk;
        }
    }

    /**
     * @return CloudFileServiceContract
     */
    public function upload()
    {
        $filePath     =  $this->getFilePath();
        $storage      = \Storage::disk($this->fileSystemDisk);
        $this->status = $storage->put(
            $filePath,
            file_get_contents($this->file)
        );

        $this->uploadedFilePath = config('services.aws.url') . $filePath;
        return $this;
    }

    /**
     * @param int $tenantId
     * @return CloudFileServiceContract
     */
    public function setTenantId($tenantId)
    {
        $this->tenantId = $tenantId;
        return $this;
    }

    /**
     * @param string $subPath
     * @return CloudFileServiceContract
     */
    public function setSubPath($subPath)
    {
        $this->subPath = $subPath;
        return $this;
    }

    /**
     * @param string $url
     * @return CloudFileServiceContract
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @param UploadedFile|string $file
     * @return CloudFileServiceContract
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return string
     */
    public function getCloudFilePath()
    {
        return $this->uploadedFilePath;
    }

    /**
     * @return string
     */
    private function getPath()
    {
        return self::BASE_PATH . $this->tenantId . "/$this->subPath/";
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->status === true;
    }

    /**
     * @return string
     */
    private function getFilePath()
    {
        if (str_contains($this->file, 'data:image')) {
            //get image type from data:image/jpeg
            $imageType = explode('/', explode(';', $this->file)[0])[1];
            $imageFileName = Str::uuid() . '.' . $imageType;
        } else {
            $imageFileName = Str::uuid() . '.' . $this->file->getClientOriginalExtension();
        }

        return $this->getPath()  . $imageFileName;
    }

    /**
     * @return CloudFileServiceContract
     */
    public function delete()
    {
        $cloudPath = substr($this->url, strpos($this->url, ".com") + 4);

        $storage      = \Storage::disk($this->fileSystemDisk);
        $this->status = $storage->delete($cloudPath);
        return $this;
    }

    /**
     * @return string
     */
    public function getPreSignedUrl($path = '')
    {
        if (empty($path)) {
            $path = $this->getCloudFilePath();
        }

        $storage = \Storage::disk($this->fileSystemDisk);
        return $storage->temporaryUrl($path, now()->addMinutes(20));
    }
}
