<?php

/**
 * @var \App\Models\Order $order
 */

?>
@extends('layouts.panel')

@section('title')Ордер: #{{ $order->id }}@endsection
@section('description')Ордер: #{{ $order->id }}@endsection

@push('style')
    <style>
      .status-new{color:#09c2de !important}
      .status-pending{color:#f4bd0e !important}
      .status-accepted{color:#1ee0ac !important}
      .status-rejected{color:#e85347 !important}
    </style>
@endpush

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Ордер #{{ $order->id }}</h3>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-xxl-3 col-lg-4">
                <div class="card card-bordered">
                    <div class="card-inner">
                        <div class="team">
                            <div class="user-card user-card-s2">
                                <div class="user-avatar md bg-primary">
                                    <img src="{{ asset($order->user->avatar) }}" alt="">
                                </div>
                                <div class="user-info">
                                    <h6>{{ $order->user->name }}</h6>
                                    <span class="sub-text">{{ $order->user->email }}</span>
                                </div>
                            </div>
                            <div class="team-details">
                                <span class="text-primary">{{ $order->user->roleName() }}</span>
                            </div>
                            <ul class="team-statistics">
                                <li><span>{{ $order->user->reviews_count }}</span><span>Отзывы</span></li>
                                <li><span>{{ $order->user->comments_count }}</span><span>Комментарии</span></li>
                                <li><span>{{ $order->user->reviews_count + $order->user->comments_count }}</span><span>Рейтинг</span></li>
                            </ul>
                            <div class="team-view">
                                <a href="{{ route('panel.users.show', $order->user) }}" class="btn btn-round btn-outline-light w-200px">
                                    <span>Посмотреть профиль</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-9 col-lg-8">
                <div class="card card-bordered">
                    <div class="card-inner">
                        @if($order->isOpen())
                            <h6 class="status-{{ $order->status }}">{{ $order->status_text }}</h6>
                        @endif
                        <div class="fw-bold text-secondary">Сумма</div>
                        <div class="user-balance">
                            <span class="balance">{{ $order->amount_format }}</span>
                            <small class="currency currency-usd">@currencyIcon</small></div>
                        <div class="fw-bold text-secondary">Платёжная информация</div>
                        <div>@nl2br($order->info)</div>
                    </div>
                </div>
                @if($order->isOpen())
                    <form class="card card-bordered crutch-validate is-alter" action="{{ route('panel.orders.update', $order) }}">
                        <div class="card-inner">
                            <div class="row g-gs">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label" for="rubric_id">Статус</label>
                                        <div class="form-control-wrap" id="status">
                                            <!--suppress HtmlFormInputWithoutLabel -->
                                            <select class="form-control form-select select2-hidden-accessible"
                                                    name="status"
                                                    data-placeholder="Выбрать"
                                                    required data-msg="Выберите Статус">
                                                <option label="empty" value=""></option>
                                                @foreach(\App\Models\Order::statusList() as $key => $status)
                                                    <option value="{{ $key }}" @selected($key === $order->status)>
                                                        {{ $status }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9 align-self-end">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Сохранить</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @else
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <h5 class="card-title status-{{ $order->status }}">{{ $order->status_text }}</h5>
                            <h6 class="card-subtitle mb-2">
                                <span>{{ $order->created_at->format('d.m.Y H:i:s') }}</span>
                                <span>({{ $order->updated_at->diffForHumans() }})</span>
                            </h6>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
