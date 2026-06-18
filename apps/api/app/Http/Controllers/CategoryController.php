<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\CategoryService;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $service)
    {
    }

    public function index(): Collection
    {
        return $this->service->index();
    }

    public function store(StoreCategoryRequest $request): Model
    {
        return $this->service->store($request->validated());
    }

    public function update(UpdateCategoryRequest $request, Category $category): Model
    {
        return $this->service->update($category, $request->validated());
    }

    public function destroy(Category $category): void
    {
        $this->service->destroy($category->id);
    }
}
