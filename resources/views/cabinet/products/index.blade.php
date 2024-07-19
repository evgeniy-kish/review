<?php

/**
 * @var \App\Models\Product[] $products
 */

?>
@extends('layouts.cabinet')

@section('title', __('My objects'))
@section('description', __('My objects'))

@section('content')
    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('cabinet.index') }}">{{ __('Cabinet') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Products') }}</li>
        </ul>
    </nav>

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">{{ __('Companies') }}</h3>
                <div class="nk-block-des text-soft">
                    <p>Всего {{ $products->total() }} {{ trans_choice('dic.companies', $products->total()) }}</p>
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
                                    <em class="icon ni ni-plus"></em><span>{{ __('Create an application for representation') }}</span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="search-balance">
        @if($products->isNotEmpty())
            @include('cabinet.products.table', compact('products'))
            <div class="card-inner">
                <div class="nk-block-between-md g-3">
                    <div class="g">
                        {{ $products->onEachSide(1)->links('panel.partials.paginate') }}
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
                    <h5 class="modal-title">{{ __('Application for representation') }}</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="{{ route('cabinet.products.introduce') }}" class="crutch-validate is-alter" method="post">
                        <div class="form-group">
                            <label class="form-label" for="email">Email {{ __('to contact') }}</label>
                            <div class="form-control-wrap">
                                <input type="email" class="form-control" name="email"
                                        id="email" value="{{ auth()->user()->email }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="message">{{ __('Message') }}</label>
                            <div class="form-control-wrap">
                            <textarea style="min-height: 120px" class="form-control form-control-sm valid"
                                    id="message" name="message" placeholder="" required></textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary">{{ __('Create a request') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    {{--<script src="/js/panel/search.js"></script>--}}
@endpush