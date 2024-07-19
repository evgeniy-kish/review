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
                        <div class="nk-tb-col"><span class="sub-text">{{ __('Type') }}</span></div>
                        <div class="nk-tb-col"><span class="sub-text">{{ __('Amount') }}</span></div>
                        <div class="nk-tb-col"><span class="sub-text">{{ __('Requisites') }}</span></div>
                        <div class="nk-tb-col"><span class="sub-text">{{ __('Status') }}</span></div>
                        <div class="nk-tb-col tb-col-md text-right"><span class="sub-text">{{ __('Date') }}</span></div>
                    </div>

                    @foreach($orders as $order)
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                {{ __('Withdrawal of funds') }}
                            </div>
                            <div class="nk-tb-col">
                                <span class="fw-bold">{{ $order->amount_format }} @currencyIcon</span>
                            </div>
                            <div class="nk-tb-col">
                                {{ $order->info }}
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