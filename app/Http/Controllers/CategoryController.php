<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\DataTables\CategoryDataTable;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'name.en' => ['required', 'string', 'max:255'],
            'name.ar' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:categories,slug'],
        ]);

        $category = new Category();

        $category->slug = !empty($validated['slug'])
            ? Str::slug($validated['slug'])
            : Str::slug($validated['name']['en']);

        $category->translateOrNew('en')->name = $validated['name']['en'];
        $category->translateOrNew('ar')->name = $validated['name']['ar'];

        $category->save();

       return redirect()
          ->route('category.index')
          ->with('success', __('messages.category_created_successfully'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('category.index', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
         return view('category.form', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name.en' => ['required', 'string', 'max:255'],
            'name.ar' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:categories,slug,' . $category->id,
            ],
        ]);

         $category->slug = !empty($validated['slug'])
            ? Str::slug($validated['slug'])
            : Str::slug($validated['name']['en']);

        $category->translateOrNew('en')->name = $validated['name']['en'];
        $category->translateOrNew('ar')->name = $validated['name']['ar'];

        $category->save();

        return redirect()
            ->route('category.index')
             ->with('success', __('messages.category_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->products()->exists()) {
            return redirect()
                ->route('category.index')
                ->with('error', __('messages.category_delete_error'));
        }

        $category->delete();

        return redirect()
             ->route('category.index')
             ->with('success', __('messages.category_deleted_successfully'));
    }
}
