<?php

/**
 * @var \App\Models\Order[] $mod_orders
 * @var \App\Models\Order[] $orders
 */

?>
@extends('layouts.panel')

@section('title', 'Ордеры')
@section('description', 'Ордеры')

@push('style')
    <style>
      .status-new{color:#09c2de !important}
      .status-pending{color:#f4bd0e !important}
      .status-accepted{color:#1ee0ac !important}
      .status-rejected{color:#e85347 !important}
    </style>
@endpush

@section('content')
    @if($mod_orders->isNotEmpty())
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Ордеры на модерации</h3>
                    <div class="nk-block-des text-soft">
                        <p>Всего {{ $mod_orders->count() }} {{ trans_choice('dic.orders', $mod_orders->count()) }}</p>
                    </div>
                </div>
            </div>
        </div>
        @include('panel.orders.table', ['orders' => $mod_orders])
    @endif

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Все ордеры</h3>
                <div class="nk-block-des text-soft">
                    <p>Всего {{ $orders->total() }} {{ trans_choice('dic.orders', $orders->total()) }}</p>
                </div>
            </div>

            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu">
                        <em class="icon ni ni-more-v"></em>
                    </a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right"><em class="icon ni ni-search"></em></div>
                                    <!--suppress HtmlFormInputWithoutLabel -->
                                    <input
                                            class="form-control panel-search"
                                            data-search-target="#search-orders"
                                            data-search-url="{{ route('panel.search.orders') }}"
                                            type="text"
                                            placeholder="Поиск"
                                    >
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="search-orders">
        @include('panel.orders.table', ['orders' => $orders])
        <div class="card-inner">
            <div class="nk-block-between-md g-3">
                <div class="g">
                    {{ $orders->onEachSide(2)->links('panel.partials.paginate') }}
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script src="/js/panel/search.js"></script>
@endpush