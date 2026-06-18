<?php

namespace App\Factories\FileFactory;

use App\Abstracts\AbstractAwsFileManager;
use App\Abstracts\AbstractFileManager;
use App\Helpers\Logit;
use App\Models\CollectionItemImage;
use Illuminate\Database\Eloquent\Model;

class CollectionItemFileManager extends AbstractAwsFileManager
{
    protected function setSubPath(): void
    {
        $this->subPath = 'collection_items';
    }

    public function finalize(): AbstractFileManager
    {
        if ($this->cloudService->isSuccess()) {
            CollectionItemImage::query()->updateOrCreate([
                'collection_item_id' => $this->entity->id,
                'url' => $this->cloudService->getCloudFilePath()
            ]);
        } else {
            $message = 'Unable to upload file for ' . $this->entity->getMorphClass() . ' with id ' . $this->entity->id;
            Logit::notice($message);
        }

        return $this;
    }

    public function getEntity(): Model
    {
        return $this->entity->load('images');
    }
}
