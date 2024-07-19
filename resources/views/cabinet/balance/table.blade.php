<?php

/**
 * @var \App\Models\BalanceStream[] $balance
*/

?>
<div class="nk-block">
    <div class="card card-bordered card-stretch">
        <div class="card-inner-group">
            <div class="card-inner p-0">
                <div class="nk-tb-list nk-tb-ulist">
                    <div class="nk-tb-item nk-tb-head">
                        <div class="nk-tb-col"><span class="sub-text">{{ __('Type') }}</span></div>
                        <div class="nk-tb-col"><span class="sub-text">{{ __('Reason') }}</span></div>
                        <div class="nk-tb-col"><span class="sub-text">{{ __('Change') }}</span></div>
                        <div class="nk-tb-col"><span class="sub-text">{{ __('Current') }}</span></div>
                        <div class="nk-tb-col tb-col-md text-right"><span class="sub-text">{{ __('Date') }}</span></div>
                    </div>

                    @foreach($balance as $operation)
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                {{ $operation->type_text }}
                            </div>
                            <div class="nk-tb-col">
                                {!! $operation->typeData() !!}
                            </div>
                            <div class="nk-tb-col">
                                <span class="fw-bold baldur-{{ $operation->baldur() }}">{{ $operation->charge_format }}</span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="fw-bold">{{ $operation->current_format }}</span>
                            </div>
                            <div class="nk-tb-col tb-col-md text-right"><span>{{ $operation->created_at->format('d-m-Y H:i') }}</span></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>