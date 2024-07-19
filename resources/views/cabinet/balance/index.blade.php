<?php

/**
 * @var \App\Models\Order[]        $orders
 * @var \App\Models\BalanceStream[] $balance
 */

?>
@extends('layouts.cabinet')

@section('title', __('Balance history'))
@section('description', __('Balance history'))

@push('style')
    <style>
      .baldur-0{color:#e85347 !important}
      .baldur-1{color:#1ee0ac !important}
      .baldur-1::before{content:'+'}
      .status-new{color:#09c2de !important}
      .status-pending{color:#f4bd0e !important}
      .status-accepted{color:#1ee0ac !important}
      .status-rejected{color:#e85347 !important}
    </style>
@endpush

@section('content')
    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('cabinet.index') }}">{{ __('Cabinet') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Balance') }}</li>
        </ul>
    </nav>

    @if($orders->isNotEmpty())
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">
                        <a href="{{ route('cabinet.orders.index') }}">
                            <span>{{ __('Balance') }} {{ auth()->user()->balance }} @currencyIcon</span>
                            <span class="text-warning">{{ __('Hold') }} {{ auth()->user()->hold }} @currencyIcon</span>
                        </a>
                    </h5>
                </div>
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                        {{-- <div class="toggle-expand-content" data-content="pageMenu">
                             <ul class="nk-block-tools g-3">
                                 <li>
                                     <div class="form-control-wrap">
                                         <div class="form-icon form-icon-right"><em class="icon ni ni-search"></em>
                                         </div>
                                         <input
                                                 class="form-control panel-search"
                                                 data-search-target="#search-reviews"
                                                 data-search-url="{{ route('cabinet.search.review') }}"
                                                 type="text"
                                                 placeholder="Поиск"
                                         >
                                     </div>
                                 </li>
                             </ul>
                         </div>--}}
                    </div>
                </div>
            </div>
        </div>

        @include('cabinet.orders.table', compact('orders'))
    @endif

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">{{ __('Balance history') }}</h3>
                <div class="nk-block-des text-soft">
                    <p>{{ __('Total') }} {{ $balance->total() }} {{ trans_choice('dic.operations', $balance->total()) }}</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                    {{-- <div class="toggle-expand-content" data-content="pageMenu">
                         <ul class="nk-block-tools g-3">
                             <li>
                                 <div class="form-control-wrap">
                                     <div class="form-icon form-icon-right"><em class="icon ni ni-search"></em>
                                     </div>
                                     <input
                                             class="form-control panel-search"
                                             data-search-target="#search-reviews"
                                             data-search-url="{{ route('cabinet.search.review') }}"
                                             type="text"
                                             placeholder="Поиск"
                                     >
                                 </div>
                             </li>
                         </ul>
                     </div>--}}
                </div>
            </div>
        </div>
    </div>

    <div id="search-balance">

        @include('cabinet.balance.table', compact('balance'))

        <div class="card-inner">
            <div class="nk-block-between-md g-3">
                <div class="g">
                    {{ $balance->onEachSide(1)->links('panel.partials.paginate') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    {{--<script src="/js/panel/search.js"></script>--}}
@endpush