<?php

namespace App\Factories\FileFactory;

use App\Abstracts\AbstractAwsFileManager;
use App\Abstracts\AbstractFileManager;
use App\Helpers\Logit;

class WebsiteContentFileManager extends AbstractAwsFileManager
{
    protected function setSubPath(): void
    {
        $this->subPath = 'website_content';
    }

    public function finalize(): AbstractFileManager
    {
        if ($this->cloudService->isSuccess()) {
            $this->entity->update(['value' => $this->cloudService->getCloudFilePath()]);
        } else {
            $message = 'Unable to upload file for ' . $this->entity->getMorphClass() . ' with id ' . $this->entity->id;
            Logit::notice($message);
        }

        return $this;
    }
}
