<?php

/**
 * @var \App\Models\User[] $users
 */

?>
@extends('layouts.panel')

@section('title')Пользователи@endsection
@section('description')Пользователи@endsection

@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Все пользователи</h3>
                <div class="nk-block-des text-soft">
                    <p>Всего {{ $users->total() }} {{ trans_choice('dic.user', $users->total()) }}</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right"><em class="icon ni ni-search"></em></div>
                                    <input
                                            class="form-control panel-search"
                                            data-search-target="#search-users"
                                            data-search-url="{{ route('panel.search.users') }}"
                                            type="text"
                                            placeholder="Поиск"
                                    >
                                </div>
                            </li>
                            <li class="nk-block-tools-opt">
                                <a id="reviews-destroy-all" href="<?= route('panel.users.create') ?>" class="btn btn-primary">
                                    <span>Создать нового пользователя</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="search-users">
        @include('panel.users.table', compact('users'))
        <div class="card-inner">
            <div class="nk-block-between-md g-3">
                <div class="g">
                    {{ $users->onEachSide(2)->links('panel.partials.paginate') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="/js/panel/search.js"></script>
@endpush
