<?php

namespace App\Http\Controllers\Cabinet;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Http\Requests\Cabinet\ProductRequest;
use App\Http\Requests\Cabinet\NewProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = $request->user()
            ->products()
            ->with(['category' => fn($query) => $query->with('parent')])
            ->withCount('reviews')
            ->withCount('values')
            ->withCount('photos')
            ->paginate(10);

        return view('cabinet.products.index', compact('products'));
    }

    public function create()
    {
        return view('cabinet.products.create');
    }

    /**
     * @param NewProductRequest $request
     *
     * @return JsonResponse
     * @noinspection DuplicatedCode
     */
    public function store(NewProductRequest $request)
    {
        $data = Arr::except($request->validated(), 'attributes');
        $product = Product::create($data);

        foreach ($product->category->allAttributes() as $attribute) {
            $value = $request['attributes'][$attribute->id] ?? null;

            if (!empty($value)) {
                $product->values()->create([
                    'attribute_id' => $attribute->id,
                    'value'        => $value,
                ]);
            }
        }

        session()->flash('flash', ['message' => 'Продукт добавлен']);

        return response()->json(['redirect' => $product->getFullPath()]);
    }

    public function attributes(Category $category)
    {
        return response()->json([
            'response'   => 'OK',
            'attributes' => View::make('cabinet.products.attributes', [
                'attributes' => $category->allAttributes(),
            ])->render(),
        ]);
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);

        return view('cabinet.products.edit', compact('product'));
    }

    public function update(Product $product, ProductRequest $request)
    {
        $this->authorize('update', $product);

        $product->update($request->validated());

        session()->flash('flash', ['message' => 'Продукт обновлен']);

        return response()->json(['redirect' => route('cabinet.products.edit', $product)]);
    }
}
