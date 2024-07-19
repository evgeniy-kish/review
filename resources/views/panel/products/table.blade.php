<div class="nk-block">
    <div class="card card-bordered card-stretch">
        <div class="card-inner-group">
            <div class="card-inner p-0">
                <div class="nk-tb-list nk-tb-ulist">
                    <div class="nk-tb-item nk-tb-head">
                        <div class="nk-tb-col"><span class="sub-text">Заголовок</span></div>
                        <div class="nk-tb-col tb-col-sm"><span class="sub-text"><em class="icon ni ni-list"></em></span></div>
                        <div class="nk-tb-col tb-col-sm"><span class="sub-text"><em class="icon ni ni-file-img"></em></span></div>
                        <div class="nk-tb-col"><span class="sub-text">Рейтинг</span></div>
                        <div class="nk-tb-col tb-col-mb"><span class="sub-text">Категория</span></div>
                        <div class="nk-tb-col tb-col-sm"><span class="sub-text">Отзывы</span></div>

                        <div class="nk-tb-col nk-tb-col-tools text-right">
                            <em class="icon ni ni-setting-alt"></em>
                        </div>
                    </div>

                    @foreach($products as $product)
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <a href="{{ route('panel.products.edit', $product) }}"><span class="fw-medium">{{ $product->title }}</span></a>
                            </div>
                            <div class="nk-tb-col tb-col-sm"><span>{{ $product->values_count }}</span></div>
                            <div class="nk-tb-col tb-col-sm">
                                <a href="{{ route('panel.products.gallery.edit', $product) }}" data-toggle="tooltip" data-placement="top" title="Редактировать галерею">{{ $product->photos_count }}</a>
                            </div>
                            <div class="nk-tb-col">
                                <span class="fw-medium">{{ $product->ratingFormat() }}</span>
                            </div>
                            <div class="nk-tb-col tb-col-mb">
                                <a href="#">{{ $product->category->title }}</a>
                            </div>
                            <div class="nk-tb-col tb-col-sm"><span>{{ $product->reviews_count }}</span></div>

                            <div class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    @if ($product->trashed())
                                        <li class="nk-tb-action-hidden">
                                            <form action="{{ route('panel.products.restore', $product) }}" method="post">
                                                <button type="submit" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Восстановить"><em class="icon ni ni-history"></em></button>
                                                @csrf
                                            </form>
                                        </li>
                                        <li>
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li>
                                                            <a href="#"><em class="icon ni ni-opt-dot-fill"></em><span>Настройки</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @else
                                        <li class="nk-tb-action-hidden">
                                            <a href="{{ route('panel.products.edit', $product) }}" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Редактировать"><em class="icon ni ni-edit-fill"></em></a>
                                        </li>
                                        <li class="nk-tb-action-hidden">
                                            <a href="{{ route('reviews.product', ['category1' => $product->category->parent->slug, 'category2' => $product->category->slug, 'product' => $product->slug]) }}" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Посмотреть на сайте" target="_blank"><em class="icon ni ni-eye-fill"></em></a>
                                        </li>
                                        <li class="nk-tb-action-hidden">
                                            <form action="{{ route('panel.products.destroy', $product) }}" method="post" onsubmit="return confirm('Удалить продукт?')">
                                                <button type="submit" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Удалить"><em class="icon ni ni-trash-fill"></em></button>
                                                @csrf
                                            </form>
                                        </li>
                                        <li>
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li>
                                                            <a href="#"><em class="icon ni ni-opt-dot-fill"></em><span>Настройки</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>