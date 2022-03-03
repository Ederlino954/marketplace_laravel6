<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryRequestUpdate;
use App\Classes\Enc;

class AdminCategoryController extends Controller
{
	private $category;

	public function __construct(Category $category)
	{
		$this->category = $category;
	}

    public function index()
    {
	    $categories = $this->category->paginate(10);

	    return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
	    return view('admin.categories.create');
    }


    public function store(CategoryRequest $request)
    {
	    $data = $request->all();

	    $category = $this->category->create($data);

	    flash('Categoria Criado com Sucesso!')->success();
	    return redirect()->route('admin.categories.index');
    }


    public function show($id)
    {
        //
    }

    public function edit($idEncProduct)
    {
        // dd($idEncProduct);
        $category = Enc::desencriptar($idEncProduct);
        // dd($category);
	    $category = $this->category->findOrFail($category);

	    return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequestUpdate $request, $category)
    {
	    $data = $request->all();

	    $category = $this->category->find($category);
	    $category->update($data);

	    flash('Categoria Atualizada com Sucesso!')->success();
	    return redirect()->route('admin.categories.index');
    }

    public function destroy($idEncProduct)
    {
        // dd($idEncProduct);
        $category = Enc::desencriptar($idEncProduct);
        // dd($category);

	    $category = $this->category->find($category);
	    $category->delete();

	    flash('Categoria Removida com Sucesso!')->success();
	    return redirect()->route('admin.categories.index');
    }
}
