<?php

/**
 * @var \App\Models\Review[] $reviews
 */

?>
@extends('layouts.cabinet')

@section('title', __('My reviews'))
@section('description', __('My reviews'))

@section('content')
    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('cabinet.index') }}">{{ __('Cabinet') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Reviews') }}</li>
        </ul>
    </nav>

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">{{ __('My reviews') }}</h3>
                <div class="nk-block-des text-soft">
                    <p>{{ __('Total') }} {{ $reviews->total() }} {{ trans_choice('dic.review', $reviews->total()) }}</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right"><em class="icon ni ni-search"></em>
                                    </div>
                                    <!--suppress HtmlFormInputWithoutLabel -->
                                    <input
                                            class="form-control panel-search"
                                            data-search-target="#search-reviews"
                                            data-search-url="{{ route('cabinet.search.review') }}"
                                            type="text"
                                            placeholder="{{ __('Search') }}"
                                    >
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="search-reviews">
        @include('cabinet.reviews.table', ['reviews' => $reviews])
        <div class="card-inner">
            <div class="nk-block-between-md g-3">
                <div class="g">
                    {{ $reviews->onEachSide(2)->links('panel.partials.paginate') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="/js/panel/search.js"></script>
@endpush