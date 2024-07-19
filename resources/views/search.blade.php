<?php

/**
 * @var Product[] $products
 */

use App\Models\Product;

$params_rate = parseRating(request('rate')) ?: [];
$params_select = [
    ['name' => 'reviews', 'value' => '1', 'title' => 'По рейтингу'],
    ['name' => 'date', 'value' => 'desc', 'title' => 'По дате ↑'],
    ['name' => 'date', 'value' => 'asc' , 'title' => 'По дате ↓'],
];

?>
@extends('layouts.app', ['h' => 'header2', 'search' => true])

@section('title', __('Search'))
@section('description', __('Search'))

@section('content')
    <!-- Breadcrumb Area-->
    <div class="breadcrumb--area bg-img bg-overlay--gray jarallax" style="background-image: url('/img/custom-img/categories.jpg');">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="breadcrumb-title">{{ __('Search') }}: {{ request('text') }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item">{{ __('Found') }}: {{ $products->total() }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reviews category Area-->
    <div class="shop-with-sidebar section-padding-120-0">
        <div class="container">
            <div class="row">
                @if($products->isNotEmpty())
                    <!-- Shop Meta Data-->
                    <div class="col-12">
                        <div class="shop-meta-data d-sm-flex align-items-center justify-content-between section-padding-0-120">
                            <!-- Total Product View-->
                            <div class="total-product-view mb-4 mb-sm-0"><span>{{ __('Presented') }}<span class="rs-counter">{{ $products->count() }}</span>{{ __('companies of') }}<span class="rs-counter">{{ $products->total() }}</span></span></div>
                            <!-- Shorting Data-->
                            <select id="check-select">
                                @foreach($params_select as $item)
                                    <option
                                            value="{{ $item['value'] }}"
                                            data-name="{{ $item['name'] }}"
                                            {{ request($item['name']) === $item['value'] ? 'selected': '' }}
                                    >
                                        {{ $item['title'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif
                <div class="col-12 col-sm-5 col-md-4">
                    <div class="shop-sidebar-area section-padding-0-120">
                        <!-- Single Widget-->
                        {{--                        <div class="shop-widget mb-5">--}}
                        {{--                            <h4 class="widget-title mb-4">Категория</h4>--}}
                        {{--                            <!-- Description-->--}}
                        {{--                            <div class="widget-desc">--}}
                        {{--                                <!-- Single Checkbox-->--}}
                        {{--                                <div class="form-check mb-2">--}}
                        {{--                                    <input class="form-check-input" id="customCheck1" type="checkbox" value="" checked>--}}
                        {{--                                    <label class="form-check-label" for="customCheck1">Авто и мото<span class="ms-2">(32)</span></label>--}}
                        {{--                                </div>--}}
                        {{--                                <!-- Single Checkbox-->--}}
                        {{--                                <div class="form-check mb-2">--}}
                        {{--                                    <input class="form-check-input" id="customCheck2" type="checkbox" value="">--}}
                        {{--                                    <label class="form-check-label" for="customCheck2">В городе<span class="ms-2">(46)</span></label>--}}
                        {{--                                </div>--}}
                        {{--                                <!-- Single Checkbox-->--}}
                        {{--                                <div class="form-check mb-2">--}}
                        {{--                                    <input class="form-check-input" id="customCheck3" type="checkbox" value="">--}}
                        {{--                                    <label class="form-check-label" for="customCheck3">Все для дома и сада<span class="ms-2">(13)</span></label>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <!-- Single Widget-->
                        {{--                        <div class="shop-widget mb-5">--}}
                        {{--                            <h4 class="widget-title mb-4">Тэг</h4>--}}
                        {{--                            <!-- Description-->--}}
                        {{--                            <div class="widget-desc">--}}
                        {{--                                <!-- Single Checkbox-->--}}
                        {{--                                <div class="form-check mb-2">--}}
                        {{--                                    <input class="form-check-input" id="customCheck16" type="checkbox" value="">--}}
                        {{--                                    <label class="form-check-label" for="customCheck16">Еда</label>--}}
                        {{--                                </div>--}}
                        {{--                                <!-- Single Checkbox-->--}}
                        {{--                                <div class="form-check mb-2">--}}
                        {{--                                    <input class="form-check-input" id="customCheck17" type="checkbox" value="">--}}
                        {{--                                    <label class="form-check-label" for="customCheck17">Электроника</label>--}}
                        {{--                                </div>--}}
                        {{--                                <!-- Single Checkbox-->--}}
                        {{--                                <div class="form-check mb-2">--}}
                        {{--                                    <input class="form-check-input" id="customCheck18" type="checkbox" value="">--}}
                        {{--                                    <label class="form-check-label" for="customCheck18">Отдых</label>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <!-- Single Widget-->
                        <div class="shop-widget">
                            <h4 class="widget-title mb-4">{{ __('rating') }}</h4>
                            <!-- Description-->
                            <div class="widget-desc" id="check-wrapper">
                                @foreach(range(5,1) as $rate)
                                    <!-- Single Checkbox-->
                                    <div class="form-check mb-2">
                                        <input
                                                class="form-check-input check-rating"
                                                id="customCheck2{{ $rate }}"
                                                type="checkbox"
                                                value="{{ $rate }}"
                                        @if(in_array($rate,$params_rate, true)) checked @endif
                                        >
                                        <label class="form-check-label" for="customCheck2{{ $rate }}">{{ $rate }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-7 col-md-8">
                    @if($products->isNotEmpty())
                        <div class="row g-5">
                            @foreach($products as $product)
                                <!-- Single Shop Card-->
                                <a href="{{ route('reviews.product', ['category1' => $product->category->parent->slug, 'category2' => $product->category->slug, 'product' => $product->slug]) }}" class="col-12 col-sm-6 col-lg-4">
                                    <div class="card shop-card {{ $product->isPremium() ? 'premium': '' }}">
                                        <div class="product-meta d-flex align-items-center justify-content-center p-2">
                                            <div class="product-name">
                                                <h4>{{ $product->title }}</h4>
                                            </div>
                                        </div>
                                        <div class="card-body p-2 text-center">
                                            <ul class="ratings-list d-flex align-items-center justify-content-center mb-3">
                                                @foreach(range(1,5) as $star)
                                                    @if($product->rating >= $star)
                                                        <li><i class="lni-star-filled"></i></li>
                                                    @else
                                                        <li><i class="lni-star-empty"></i></li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                            <span>{{ $product->rating }} из 5 ({{ $product->reviews_count }} {{ trans_choice('dic.review', $product->reviews_count) }})</span>
                                        </div>
                                        <div class="product-img-wrap">
                                            <img class="card-img-bottom" src="{{ $product->img ?: '/img/special/no-image-300x300.png' }}" alt="{{ $product->title }}">
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="alert alert-warning">Нет данных</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination Area-->
    {{ $products->onEachSide(1)->links('partials.paginate', ['class' => 'mt-5']) }}
@endsection

@push('script')
<script>
  (function() {
    const
      check = $('#check-wrapper'),
      select = $('#check-select');

    const windowData = Object.fromEntries(
      new URL(window.location).searchParams.entries()
    );

    check.on('change', '.check-rating', function () {
      const params = [];

      check.find('input:checked').each(function (key, input) {
        params.push(+input.value);
      });

      windowData.rate = JSON.stringify(params);

      window.location.replace(`${window.location.pathname}?${$.param(windowData)}`);
    });

    select.on('change', function () {
      const option = $('option:selected', this);
      ['date', 'reviews'].forEach(v => delete windowData[v]);

      windowData[option.data('name')] = option.val();
      window.location.replace(`${window.location.pathname}?${$.param(windowData)}`);
    });

  })(jQuery);
</script>
@endpush