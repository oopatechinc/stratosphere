<?php

namespace App\Factories\FileFactory;

use App\Abstracts\AbstractAwsFileManager;
use App\Abstracts\AbstractFileManager;
use App\Helpers\Logit;

class CategoryFileManager extends AbstractAwsFileManager
{
    protected function setSubPath(): void
    {
        $this->subPath = 'category';
    }

    public function finalize(): AbstractFileManager
    {
        if ($this->cloudService->isSuccess()) {
            $this->entity->update(['image_url' => $this->cloudService->getCloudFilePath()]);
        } else {
            $message = 'Unable to upload file for ' . $this->entity->getMorphClass() . ' with id ' . $this->entity->id;
            Logit::notice($message);
        }

        return $this;
    }
}
