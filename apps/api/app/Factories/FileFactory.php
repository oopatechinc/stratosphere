<?php

namespace App\Factories;

use App\Abstracts\AbstractFileManager;
use App\Factories\FileFactory\CategoryFileManager;
use App\Factories\FileFactory\CollectionItemFileManager;
use App\Factories\FileFactory\ServiceFileManager;
use App\Factories\FileFactory\StaffFileManager;
use App\Factories\FileFactory\WebsiteContentFileManager;
use App\Models\Category;
use App\Models\CollectionItem;
use App\Models\Property;
use App\Models\Service;
use App\Models\Staff;
use App\Models\WebsiteContent;
use Illuminate\Http\UploadedFile;

class FileFactory
{
    const ENTITY_TYPE_CATEGORY = 'category';
    const ENTITY_TYPE_SERVICE = 'service';
    const ENTITY_TYPE_STAFF = 'staff';
    const ENTITY_TYPE_WEBSITE_CONTENT = 'website_content';
    const ENTITY_TYPE_COLLECTION_ITEM = 'collectionItem';

    public function __construct(
        protected string $entityType,
        protected int $entityId,
        protected UploadedFile $file,
    ){
    }

    public function getInstance(): AbstractFileManager
    {
        return match ($this->entityType) {
            self::ENTITY_TYPE_CATEGORY => new CategoryFileManager(
                Category::query()->findOrFail($this->entityId),
                $this->file
            ),
            self::ENTITY_TYPE_SERVICE => new ServiceFileManager(
                Service::query()->findOrFail($this->entityId),
                $this->file
            ),
            self::ENTITY_TYPE_WEBSITE_CONTENT => new WebsiteContentFileManager(
                WebsiteContent::query()->findOrFail($this->entityId),
                $this->file
            ),
            self::ENTITY_TYPE_STAFF => new StaffFileManager(
                Staff::query()->findOrFail($this->entityId),
                $this->file
            ),
            self::ENTITY_TYPE_COLLECTION_ITEM => new CollectionItemFileManager(
                CollectionItem::query()->findOrFail($this->entityId),
                $this->file
            )
        };
    }
}
