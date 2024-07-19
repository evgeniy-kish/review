<?php

namespace App\Http\Controllers\Panel;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Http\Requests\Panel\ProductRequest;
use App\Http\Requests\Panel\AttributeProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest('id')
            ->with(['category' => fn($query) => $query->with('parent')])
            ->withCount('reviews')
            ->withCount('values')
            ->withCount('photos')
            ->paginate(10);

        return view('panel.products.index', compact('products'));
    }

    public function create()
    {
        return view('panel.products.create');
    }

    /**
     * @param ProductRequest $request
     *
     * @return JsonResponse
     * @noinspection DuplicatedCode
     */
    public function store(ProductRequest $request)
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

        return response()->json(['redirect' => route('panel.products.edit', $product)]);
    }

    public function edit(Product $product)
    {
        return view('panel.products.edit', compact('product'));
    }

    public function update(Product $product, ProductRequest $request)
    {
        $product->update($request->safe()->toArray());

        session()->flash('flash', ['message' => 'Продукт обновлен']);

        return response()->json(['redirect' => route('panel.products.edit', $product)]);
    }

    public function user(Product $product, Request $request)
    {
        $this->validate($request, [
            'user_id' => ['nullable', 'integer', 'exists:users,id']
        ]);

        $product->update(['user_id' => $request['user_id']]);

        session()->flash('flash', ['message' => 'Пользователь привязан']);

        return response()->json(['redirect' => route('panel.products.edit', $product)]);
    }

    public function premium(Product $product, Request $request)
    {
        $this->validate($request, [
            'days' => ['required', 'integer', 'min:0']
        ]);

        $current = $product->isPremium() ? $product->premium_at : Carbon::now();
        $date = $request['days'] ? $current?->addDays($request['days'])->format('Y-m-d H:i:s') : null;

        $product->update(['premium_at' => $date]);

        session()->flash('flash', ['message' => 'Премиум время обновлено']);

        return response()->json(['redirect' => route('panel.products.edit', $product)]);
    }

    public function actual(Product $product, Request $request)
    {
        $product->update(['actual' => (bool)$request['actual']]);

        session()->flash('flash', ['message' => 'Актуальность установлена']);

        return response()->json(['redirect' => route('panel.products.edit', $product)]);
    }

    public function updateAttributes(Product $product, AttributeProductRequest $request)
    {
        DB::transaction(static function () use ($request, $product) {
            $product->values()->delete();

            foreach ($product->category->allAttributes() as $attribute) {
                $value = $request['attributes'][$attribute->id] ?? null;

                if (!empty($value)) {
                    $product->values()->create([
                        'attribute_id' => $attribute->id,
                        'value'        => $value,
                    ]);
                }
            }

            $product->update();
        });

        session()->flash('flash', ['message' => 'Аттрибуты продукта обновлены']);

        return response()->json([
            'redirect' => route($request->routeIs('panel.products.update_attributes')
                ? 'panel.products.edit'
                : 'cabinet.products.edit', $product)
        ]);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return to_route('panel.products.index')
            ->with('flash', ['message' => 'Продукт удалён!']);
    }

    public function search(Request $request)
    {
        $products = Product::where('title', 'like', "%{$request['token']}%")
            ->orWhereHas('category', static fn($q) => $q->where('title', 'like', "%{$request['token']}%"))
            ->with(['category' => fn($query) => $query->with('parent')])
            ->withCount('reviews')
            ->withCount('values')
            ->withCount('photos')
            ->latest('id')
            ->take(30)
            ->get();

        if ($products->isEmpty()) {
            return 'Ничего не найдено';
        }

        return View::make('panel.products.table', compact('products'))->render();
    }

    public function deleted() {
        $products = Product::onlyTrashed()
            ->latest('deleted_at')
            ->with(['category' => fn($query) => $query->with('parent')])
            ->withCount('reviews')
            ->withCount('values')
            ->withCount('photos')
            ->paginate(10);

        return view('panel.products.trash', compact('products'));
    }

    public function restore(Product $product) {
        $product->restore();

        return to_route('panel.products.deleted')
            ->with('flash', ['message' => 'Продукт восстановлен!']);
    }
}
