<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $query = Resource::latest();
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        $resources = $query->paginate(10)->withQueryString();
        return view('admin.resources.index', compact('resources'));
    }

    public function create()
    {
        return view('admin.resources.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'image'=>'required|image',
            'pdf'=>'required|mimes:pdf'
        ]);

        $image = $request->file('image')->store('resources','public');
        $pdf = $request->file('pdf')->store('resources','public');

        Resource::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'image'=>$image,
            'pdf'=>$pdf
        ]);

        return redirect()->route('admin.resources.index');
    }
    public function edit(Resource $resource)
    {
        return view('admin.resources.edit', compact('resource'));
    }
    public function update(Request $request, Resource $resource)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'image'=>'nullable|image',
            'pdf'=>'nullable|mimes:pdf'
        ]);

        $image = $request->file('image') ? $request->file('image')->store('resources','public') : $resource->image;
        $pdf = $request->file('pdf') ? $request->file('pdf')->store('resources','public') : $resource->pdf;

        $resource->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'image'=>$image,
            'pdf'=>$pdf
        ]);

        return redirect()->route('admin.resources.index');
    }   
    public function destroy(Resource $resource)
    {
        $resource->delete();
        return redirect()->route('admin.resources.index');
    }
}
