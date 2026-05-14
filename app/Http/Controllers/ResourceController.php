<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ResourceController extends Controller
{
    public function index() {
        return response()->json(\App\Models\Resource::all());
    }

    public function adminIndex()
    {
        return Inertia::render('Admin/Resources', [
            'resources' => Resource::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:Helpline,Counseling Center,Hospital',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'is_24_7' => 'boolean'
        ]);

        $resource = \App\Models\Resource::create($validated);

        return redirect()->back()->with('message', 'Resource Created Successfully!');
    }

    public function destroy(\App\Models\Resource $resource)
    {
        $resource->delete();
        return redirect()->back()->with('message', 'Resource Deleted Successfully!');
    }
}
