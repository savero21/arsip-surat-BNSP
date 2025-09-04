<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LetterController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');
        $letters = Letter::with('category')
                    ->search($q)
                    ->orderByDesc('archived_at')
                    ->paginate(10)
                    ->withQueryString();

        return view('letters.index', compact('letters','q'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('letters.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'number'      => 'required|string|max:100|unique:letters,number',
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'archived_at' => 'required|date',
            'file_pdf'    => 'required|mimes:pdf|max:5120',
        ]);

        $data['file_path'] = $request->file('file_pdf')->store('surat','public');

        Letter::create($data);

        return redirect()->route('letters.index')->with('ok','Surat berhasil diarsipkan.');
    }

    public function show(Letter $letter)
    {
        return view('letters.show', compact('letter'));
    }

    public function edit(Letter $letter)
    {
        $categories = Category::orderBy('name')->get();
        return view('letters.edit', compact('letter','categories'));
    }

    public function update(Request $request, Letter $letter)
    {
        $data = $request->validate([
            'number'      => 'required|string|max:100|unique:letters,number,'.$letter->id,
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'archived_at' => 'required|date',
            'file_pdf'    => 'nullable|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('file_pdf')) {
            if ($letter->file_path && Storage::disk('public')->exists($letter->file_path)) {
                Storage::disk('public')->delete($letter->file_path);
            }
            $data['file_path'] = $request->file('file_pdf')->store('surat','public');
        }

        $letter->update($data);

        return redirect()->route('letters.index')->with('ok','Surat berhasil diperbarui.');
    }

    public function destroy(Letter $letter)
    {
        if ($letter->file_path && Storage::disk('public')->exists($letter->file_path)) {
            Storage::disk('public')->delete($letter->file_path);
        }
        $letter->delete();

        return back()->with('ok','Surat dihapus.');
    }

    /**
     * ✅ Stream file untuk preview & fetch Blob
     */
    public function stream(Letter $letter)
    {
        $path = Storage::disk('public')->path($letter->file_path);

        return response()->file($path, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.Str::slug($letter->title, '_').'.pdf"',
        ]);
    }
}
