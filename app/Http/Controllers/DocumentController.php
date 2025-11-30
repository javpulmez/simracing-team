<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Race;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Document::class, 'document');
    }

    public function index()
    {
        $documents = Document::with(['user', 'race'])
            ->latest()
            ->paginate(15);
            
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        $races = Race::where('status', '!=', 'cancelled')
            ->orderBy('race_date', 'desc')
            ->get();
            
        return view('documents.create', compact('races'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,zip|max:10240',
            'file_type' => 'required|in:setup,reglamento,guia,resultado,otro',
            'race_id' => 'nullable|exists:races,id',
        ]);

        $filePath = $request->file('file')->store('documents', 'public');

        $document = Document::create([
            'name' => $validated['name'],
            'file_path' => $filePath,
            'file_type' => $validated['file_type'],
            'race_id' => $validated['race_id'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('documents.index')
            ->with('success', 'Documento subido exitosamente.');
    }

    public function show(Document $document)
    {
        return Storage::disk('public')->download($document->file_path, $document->name);
    }

    public function edit(Document $document)
    {
        $races = Race::where('status', '!=', 'cancelled')
            ->orderBy('race_date', 'desc')
            ->get();
            
        return view('documents.edit', compact('document', 'races'));
    }

    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,zip|max:10240',
            'file_type' => 'required|in:setup,reglamento,guia,resultado,otro',
            'race_id' => 'nullable|exists:races,id',
        ]);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($document->file_path);
            $validated['file_path'] = $request->file('file')->store('documents', 'public');
        }

        $document->update($validated);

        return redirect()->route('documents.index')
            ->with('success', 'Documento actualizado exitosamente.');
    }

    public function destroy(Document $document)
    {
        Storage::disk('public')->delete($document->file_path);
        $document->delete();

        return redirect()->route('documents.index')
            ->with('success', 'Documento eliminado exitosamente.');
    }
}