<?php

namespace App\Http\Controllers;

use App\Category;

class CategoryController extends Controller
{
    public function category()
    {
        $catlist = Category::whereis_del(0)->whereparent_id(0)->orderBy('id', 'desc')->get();
        return view('category.category')->with(['catlist' => $catlist]);
    }

    public function insert_category()
    {
        $cat = new Category();
        $cat->name = request('name');
        $cat->save();
        return back()->with('message', 'Category Has Been Added');

    }

    public function edit_category($id)
    {
        $id = base64_decode($id);
        $edit = Category::find($id);
        return view('category.editcategory')->with(['edit' => $edit]);
    }

    public function update_category($id)
    {
        $cat = Category::find($id);
        $cat->name = request('name');
        $cat->save();
        return redirect('category')->with('message', 'Category Has Been Updated');
    }

    public function del_cate()
    {
        $cat = Category::find(request('did'));
        $cat->is_del = 1;
        $cat->save();
       return 'done';
    }

    ///////////sub-category

    function sub_category()
    {
        $catlist = Category::whereis_del(0)->whereparent_id(0)->orderBy('id', 'desc')->get();
        $subcatlist = Category::whereis_del(0)->whereNotIn('parent_id', [0])->orderBy('id', 'desc')->get();
        return view('category.sub_category')->with(['catlist' => $catlist , 'subcatlist'=> $subcatlist]);
    }

    function insert_subcategory()
    {
        $sub_cat = new Category();
        $sub_cat->parent_id = request('p_id');
        $sub_cat->name = request('name');
        $sub_cat->save();
        return back()->with('message', 'Sub-Category Has Been Added');
    }

    function edit_sub_category($id)
    {
    
        $id = base64_decode($id);
        $catlist = Category::whereis_del(0)->whereparent_id(0)->orderBy('id', 'desc')->get();
        $edit = Category::find($id);
        return view('category.editsubcategory')->with(['edit' => $edit , 'catlist' => $catlist]);

    }
    function update_sub_category($id)
    {
        $sub_cat = Category::find($id);
        $sub_cat->parent_id = request('p_id');
        $sub_cat->name = request('name');
        $sub_cat->save();
        return redirect('sub_category')->with('message', 'Sub-Category Has Been Updated');
    }
}
