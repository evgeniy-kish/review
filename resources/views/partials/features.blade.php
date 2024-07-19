@if($products->count())
<div class="saasbox-tab-area section-padding-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-9 col-lg-6">
                <div class="section-heading text-center"><i class="lni-crown"></i>
                    <h2>{{ __('Actual now') }}</h2>
                    <h3>{{ __('Find interesting places nearby') }}</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="tab--area">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @foreach($products as $product)
                        <li class="nav-item"><a class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab--{{ $loop->index + 1 }}" data-toggle="tab" href="#tab{{ $loop->index + 1 }}" role="tab" aria-controls="tab{{ $loop->index + 1 }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $product->category->title }}</a></li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        @foreach($products as $product)
                        <!-- Tab Pane-->
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab{{ $loop->index + 1 }}" role="tabpanel" aria-labelledby="tab--{{ $loop->index + 1 }}">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-12 col-md-6 col-xxl-5">
                                    <div class="tab--text mt-5">
                                        <h6>{{ $product->category->title }}</h6>
                                        <h2><a href="{{ route('reviews.product', ['category1' => $product->category->parent->slug, 'category2' => $product->category->slug, 'product' => $product->slug]) }}">{{ $product->title }}</a></h2>
                                        {!! Str::limit($product->body, 200) !!}
                                        <span class="d-block mt-4 mb-1">{{ __('Satisfied clients') }}: {{ $product->rating / 5 * 100 . '%' }}</span>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: {{ $product->rating / 5 * 100 . '%' }};" aria-valuenow="{{ $product->rating / 5 * 100 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="tab-thumb mt-5"><img class="img-fluid" style="height: 30vh; width: 100%; object-fit: contain;" src="{{ $product->img }}" alt="{{ $product->title }}"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif