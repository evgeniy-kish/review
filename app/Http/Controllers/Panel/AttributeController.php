<?php

namespace App\Http\Controllers\Panel;

use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\AttributeRequest;

class AttributeController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(AttributeRequest $request, Category $category)
    {
        $category->attributes()->create([
            'name'     => $request['name'],
            'type'     => $request['type'],
            'required' => (bool)$request['required'],
            'variants' => array_filter(array_map('trim', explode("\n", (string)$request['variants']))),
            'sort'     => $request['sort'],
        ]);

        session()->flash('flash', ['message' => 'Атрибут добавлен']);

        return response()
            ->json(['redirect' => route('panel.categories.attribute.show', $category)]);
    }

    public function show(Category $category)
    {
        $types = Attribute::typesList();
        $attribute = new Attribute();
        $prefix = '';

        return view('panel.categories.attributes', compact('category', 'types', 'attribute', 'prefix'));
    }

    public function edit(Category $category, Attribute $attribute)
    {
        $types = Attribute::typesList();
        $prefix = 'edit';

        return response()->json([
            'form' => View::make(
                'panel.categories.attributes_form',
                compact('category', 'types', 'attribute', 'prefix')
            )->render()
        ]);
    }

    public function update(AttributeRequest $request, Category $category, Attribute $attribute)
    {
        $category->attributes()->findOrFail($attribute->id)?->update([
            'name'     => $request['name'],
            'type'     => $request['type'],
            'required' => (bool)$request['required'],
            'variants' => array_filter(array_map('trim', explode("\n", (string)$request['variants']))),
            'sort'     => $request['sort'],
        ]);

        session()->flash('flash', ['message' => 'Атрибут обновлён']);

        return response()
            ->json(['redirect' => route('panel.categories.attribute.show', $category)]);
    }

    public function destroy(Category $category, Attribute $attribute)
    {
        $attribute->delete();

        return to_route('panel.categories.attribute.show', $category)
            ->with('flash', ['message' => 'Атрибут удалён!']);
    }
}
