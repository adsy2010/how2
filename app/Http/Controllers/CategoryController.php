<?php


namespace App\Http\Controllers;


use App\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showCreate()
    {
        return view('category.add', ['categories' => Category::all()->pluck('name', 'id')]);
    }

    public function showUpdate(Request $request, Category $id)
    {
        return view('category.edit', ['categories' => Category::all()->pluck('name', 'id'), 'category' => $id]);
    }

    public function showDelete(Request $request, Category $id)
    {
        return view('category.delete', ['category' => $id]);
    }

    public function create(Request $request)
    {
        if(!$request->isMethod('post'))
            return redirect()->to(Route('category.list'))
                ->withErrors(__('admin.error-badmethod'))
                ->send();
        try{
            Category::create([
                'name' => $request->name,
                'parent' => $request->parent
            ]);

            return redirect()->to(Route('admin.category.add'))
                ->with('success', __('category.success-added'))
                ->send();
        }
        catch (Exception $exception)
        {
            return redirect()->to(Route('admin.category.add'))
                ->withInput($request->all())
                ->withErrors(__('category.error-added'))
                ->send();
        }

    }

    public function update(Request $request, Category $id)
    {
        if(!$request->isMethod('post'))
            return redirect()->to(Route('category.list'))
            ->withErrors(__('admin.error-badmethod'))
                ->send();
        try{
            $id->name = $request->name;
            $id->parent = $request->parent;
            $id->save();
            return redirect()->to(Route('admin.category.edit'))
                ->with('success', __('category.success-updated'))
                ->send();
        }
        catch (Exception $exception)
        {
            return redirect()->to(Route('admin.category.edit'))
                ->withInput($request->all())
                ->withErrors(__('category.error-updated'))
                ->send();
        }
    }

    public function remove(Request $request, Category $id)
    {
        if(!$request->isMethod('post'))
            return redirect()->to(Route('category.list'))
            ->withErrors(__('admin.error-badmethod'))
                ->send();


        try{
            //TODO: Run this once checks are completed
            $id->delete();
            return redirect()->to(Route('admin.category.list'))
                ->with('success', __('category.success-deleted'))
                ->send();
        }
        catch (Exception $exception)
        {
            return redirect()->to(Route('admin.category.delete'))
                ->withInput($request->all())
                ->withErrors(__('category.error-deleted'))
                ->send();
        }

        //TODO: check its empty before removing or else fail OR move all under category to new one
    }

    /**
     * Display categories within a category or top level
     */
    public function listCategories(Request $request, Category $id = null)
    {
        $categories = (empty($id)) ? Category::where('parent', '<', 1)->orWhere('parent', null)->get() : $id->children;
        return view('category.list', ['categories' => $categories, 'category' => $id]);
    }

    /**
     * Display categories within a category or top level
     */
    public function listAdminCategories(Request $request, Category $id = null)
    {
        $categories = (empty($id)) ? Category::where('parent', '<', 1)->orWhere('parent', null)->get() : $id->children;
        return view('category.adminlist', ['categories' => $categories, 'category' => $id]);
    }

    /**
     * Show all categories as a tree
     */
    public function listCategoryTree()
    {
//https://itsolutionstuff.com/post/laravel-5-category-treeview-hierarchical-structure-example-with-demoexample.html
        return view('category.tree');
    }

    public function listGuidesInCategory()
    {
        return view('category.view');
    }
}