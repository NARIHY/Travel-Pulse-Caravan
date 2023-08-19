<?php

namespace App\Http\Controllers;

use App\Http\Requests\FloteCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Category of flote views
     *
     * @return View
     */
   public function index(): View
   {
        $category = Category::orderBy('id', 'asc')->paginate(5);
        return view('admin.entreprise.flote.index', [
            'category' => $category
        ]);
   }

   /**
    * Already used when user add new flote 
    *
    * @return View
    */
   public function create(): View 
   {
        $category = new Category();
        return view('admin.entreprise.flote.action.random', [
            'category' => $category
        ]);
   }

   /**
    * this store a new information given by users
    *
    * @param FloteCategoryRequest $request
    * @param Category $category
    * @return RedirectResponse
    */
   public function store(FloteCategoryRequest $request, Category $category): RedirectResponse
   {
        try {
            $data = $request->validated();
            $category = Category::create($data);
            return redirect()->route('Admin.Entreprise.flote.index')->with('success', 'Création du flotte réussi');
        } catch (\Exception $e) {
            return redirect()->route('Admin.Entreprise.flote.index')->with('error', 'Echec de la création' . $e->getMessage());
        }
        
   }

   /**
    * Neded to join the edition view
    *
    * @param string $id
    * @return View
    */
   public function edit(string $id): View 
   {
        $category = Category::findOrFail($id);
        return view('admin.entreprise.flote.action.random', [
            'category' => $category
        ]);
   }

   public function update(string $id, FloteCategoryRequest $request, Category $category): RedirectResponse
   {
        try {
            $category = Category::findOrFail($id);
            $data = $request->validated();
            $category->update($data);
            return redirect()->route('Admin.Entreprise.flote.edit', ['id' => $category->id])->with('success', 'Modification du flotte réussi');
        } catch (\Exception $e) {
            return redirect()->route('Admin.Entreprise.flote.edit')->with('error', 'Echec de la modification' . $e->getMessage());
        }
   }
}
