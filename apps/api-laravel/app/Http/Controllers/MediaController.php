<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        // For now, return all media. In a real app, scope to tenant.
        return response()->json(Media::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tenant_id' => 'required|exists:tenants,id',
        ]);

        $path = $request->file('file')->store('media', 'public');
        $url = Storage::url($path);

        $media = Media::create([
            'tenant_id' => $request->tenant_id,
            'url' => $url,
            'type' => $request->file('file')->getClientMimeType(),
        ]);

        return response()->json($media, 201);
    }

    public function destroy($id)
    {
        $media = Media::findOrFail($id);

        // Delete from storage
        $path = str_replace('/storage/', '', $media->url);
        Storage::disk('public')->delete($path);

        $media->delete();

        return response()->json(['message' => 'Media deleted successfully']);
    }
}
