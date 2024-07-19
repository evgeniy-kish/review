<?php

/**
 * @var \App\Models\Order[] $orders
 */

?>
<div class="nk-block">
    <div class="card card-bordered card-stretch">
        <div class="card-inner-group">
            <div class="card-inner p-0">
                <div class="nk-tb-list nk-tb-ulist">
                    <div class="nk-tb-item nk-tb-head">
                        <div class="nk-tb-col"><span class="sub-text">№</span></div>
                        <div class="nk-tb-col"><span class="sub-text">Сумма</span></div>
                        <div class="nk-tb-col"><span class="sub-text">Пользователь</span></div>
                        <div class="nk-tb-col"><span class="sub-text">Реквизиты</span></div>
                        <div class="nk-tb-col"><span class="sub-text">Статус</span></div>
                        <div class="nk-tb-col tb-col-md text-right"><span class="sub-text">Дата</span></div>
                    </div>
                    @foreach($orders as $order)
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                #{{ $order->id }}
                            </div>
                            <div class="nk-tb-col">
                                <a href="{{ route('panel.orders.edit', $order) }}">
                                    <span class="fw-bold">{{ $order->amount_format }} @currencyIcon</span>
                                </a>
                            </div>
                            <div class="nk-tb-col">
                                <a href="{{ route('panel.users.show', $order->user) }}">{{ $order->user->name }}</a>
                            </div>
                            <div class="nk-tb-col">
                                {{ str($order->info)->limit() }}
                            </div>
                            <div class="nk-tb-col">
                                <span class="fw-bold status-{{ $order->status }}">{{ $order->status_text }}</span>
                            </div>
                            <div class="nk-tb-col tb-col-md text-right"><span>{{ $order->updated_at->format('d-m-Y H:i') }}</span></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
