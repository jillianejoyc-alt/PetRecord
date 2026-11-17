<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PetController extends Controller
{
    public function dashboard(): View
    {
        return view('dashboard', [
            'totalPets' => Pet::count(),
            'dogs' => Pet::where('type', 'Dog')->count(),
            'cats' => Pet::where('type', 'Cat')->count(),
            'otherPets' => Pet::where('type', 'Other')->count(),
            'recentPets' => Pet::latest('date_registered')->latest('id')->limit(5)->get(),
        ]);
    }

    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));
        $pets = Pet::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('owner_name', 'like', "%{$search}%");
                });
            })
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('pets.index', compact('pets', 'search'));
    }

    public function create(): View
    {
        return view('pets.create', ['pet' => new Pet(['date_registered' => today()])]);
    }

    public function store(Request $request): RedirectResponse
    {
        $pet = Pet::create($this->validatedData($request));

        return redirect()->route('pets.show', $pet)->with('success', 'Pet record added successfully.');
    }

    public function show(Pet $pet): View
    {
        return view('pets.show', compact('pet'));
    }

    public function edit(Pet $pet): View
    {
        return view('pets.edit', compact('pet'));
    }

    public function update(Request $request, Pet $pet): RedirectResponse
    {
        $pet->update($this->validatedData($request));

        return redirect()->route('pets.show', $pet)->with('success', 'Pet record updated successfully.');
    }

    public function destroy(Pet $pet): RedirectResponse
    {
        $pet->delete();

        return redirect()->route('pets.index')->with('success', 'Pet record deleted successfully.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'type' => ['required', 'in:Dog,Cat,Other'],
            'breed' => ['nullable', 'string', 'max:100'],
            'age' => ['required', 'integer', 'min:0', 'max:200'],
            'gender' => ['required', 'in:Male,Female'],
            'owner_name' => ['required', 'string', 'max:120'],
            'contact_number' => ['required', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:2000'],
            'date_registered' => ['required', 'date'],
        ]);
    }
}