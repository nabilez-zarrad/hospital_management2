<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSpecialtyController extends Controller
{
    public function index()
    {
        $specialties = Specialty::query()
            ->latest()
            ->paginate(15);

        return view('admin.specialties.index', compact('specialties'));
    }

    public function create()
    {
        return view('admin.specialties.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('specialties', 'public');
        }

        Specialty::create($validated);

        return redirect()
            ->route('admin.specialties.index')
            ->with('success', 'Specialty created successfully.');
    }

    public function edit(Specialty $specialty)
    {
        return view('admin.specialties.edit', compact('specialty'));
    }

    public function update(Request $request, Specialty $specialty)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image'],
        ]);

        if ($request->hasFile('image')) {
            if ($specialty->image && Storage::disk('public')->exists($specialty->image)) {
                Storage::disk('public')->delete($specialty->image);
            }

            $validated['image'] = $request->file('image')->store('specialties', 'public');
        }

        $specialty->update($validated);

        return redirect()
            ->route('admin.specialties.index')
            ->with('success', 'Specialty updated successfully.');
    }

    public function destroy(Specialty $specialty)
    {
        if ($specialty->image && Storage::disk('public')->exists($specialty->image)) {
            Storage::disk('public')->delete($specialty->image);
        }

        $specialty->delete();

        return redirect()
            ->route('admin.specialties.index')
            ->with('success', 'Specialty deleted successfully.');
    }
}
