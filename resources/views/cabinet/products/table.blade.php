<?php

/**
 * @var \App\Models\Product[] $products
*/

?>
<div class="nk-block">
    <div class="card card-bordered card-stretch">
        <div class="card-inner-group">
            <div class="card-inner p-0">
                <div class="nk-tb-list nk-tb-ulist">
                    <div class="nk-tb-item nk-tb-head">
                        <div class="nk-tb-col"><span class="sub-text">{{ __('Header') }}</span></div>
                        <div class="nk-tb-col tb-col-sm"><span class="sub-text"><em class="icon ni ni-file-img"></em></span></div>
                        <div class="nk-tb-col"><span class="sub-text">{{ __('Rating') }}</span></div>
                        <div class="nk-tb-col tb-col-mb"><span class="sub-text">{{ __('Category') }}</span></div>
                        <div class="nk-tb-col tb-col-sm"><span class="sub-text">{{ __('Reviews') }}</span></div>
                    </div>

                    @foreach($products as $product)
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <a href="{{ route('cabinet.products.edit', $product) }}">
                                    <span class="fw-medium">{{ $product->title }}</span>
                                </a>
                            </div>
                            <div class="nk-tb-col tb-col-sm">
                                <a href="{{ route('cabinet.products.gallery.edit', $product) }}" data-toggle="tooltip"
                                        data-placement="top" title="{{ __('Edit Gallery') }}">{{ $product->photos_count }}</a>
                            </div>
                            <div class="nk-tb-col">
                                <span class="fw-medium">{{ $product->ratingFormat() }}</span>
                            </div>
                            <div class="nk-tb-col tb-col-mb">
                                <span>{{ $product->category->title }}</span>
                            </div>
                            <div class="nk-tb-col tb-col-sm"><span>{{ $product->reviews_count }}</span></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>