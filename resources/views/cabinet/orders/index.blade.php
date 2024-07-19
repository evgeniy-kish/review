<?php

/**
 * @var \App\Models\Order[] $orders
 */

?>
@extends('layouts.cabinet')

@section('title', __('Transaction history'))
@section('description', __('Transaction history'))

@push('style')
    <style>
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
            <li class="breadcrumb-item active">{{ __('Transaction history') }}</li>
        </ul>
    </nav>

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">{{ __('Transactions') }}</h3>
                <div class="nk-block-des text-soft">
                    <p>{{ __('Total') }} {{ $orders->total() }} {{ trans_choice('dic.operations', $orders->total()) }}</p>
                </div>
            </div>

            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu">
                        <em class="icon ni ni-menu-alt-r"></em>
                    </a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            {{--<li>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right"><em class="icon ni ni-search"></em></div>
                                    <input
                                            class="form-control panel-search"
                                            data-search-target="#search-products"
                                            data-search-url="{{ route('panel.search.products') }}"
                                            type="text"
                                            placeholder="Поиск"
                                    >
                                </div>
                            </li>--}}
                            <li class="nk-block-tools-opt">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#modalForm">
                                    <em class="icon ni ni-plus"></em><span>{{ __('Create withdrawal request') }}</span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="search-balance">
        @if($orders->isNotEmpty())
            @include('cabinet.orders.table', compact('orders'))
            <div class="card-inner">
                <div class="nk-block-between-md g-3">
                    <div class="g">
                        {{ $orders->onEachSide(1)->links('panel.partials.paginate') }}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('modal')
    <div class="modal fade" id="modalForm">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Withdrawal request') }}</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    @include('cabinet.orders.form', ['balance' => auth()->user()->balance])
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    {{--<script src="/js/panel/search.js"></script>--}}
@endpush