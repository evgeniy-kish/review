<?php

/**
 * @var int $balance
*/

?>
<form action="{{ route('cabinet.orders.store') }}" class="crutch-validate is-alter" method="post">
    <div class="form-group">
        <label class="form-label" for="opening">{{ __('Available for withdrawal') }}</label>
        <div class="form-control-wrap">
            <input type="number" class="form-control" id="opening" value="{{ $max = max($balance, 0) }}" readonly disabled>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="amount">{{ __('Amount') }}</label>
        <div class="form-control-wrap">
            <div class="input-group">
                <input type="number" class="form-control" id="amount" name="amount" min="1" max="{{ $max }}" required>
                <div class="input-group-append">
                    <button id="amount-max" class="btn btn-outline-primary" type="button">max</button>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="info">{{ __('Withdrawal method') }}</label>
        <div class="form-control-wrap">
            <textarea style="min-height: 120px" class="form-control form-control-sm valid" id="info" name="info"
                    placeholder="VISA Card Сбербанк: 1000 0000 0000 0000" required></textarea>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-lg btn-primary">{{ __('Create a request') }}</button>
    </div>
</form>

@push('script')
<!--suppress ES6ConvertVarToLetConst -->
<script>
  (function ($) {
    var _a = $('#amount'), _m = +_a.prop('max');
    $('#amount-max').on('click', function () {
      _a.val(_m);
      check();
    });
    _a.on('input', function () {
      check();
    });

    function check () {
      var _v = +_a.val();
      _a.toggleClass('error', _v <= 0 || _v > _m);
    }
  })(jQuery);
</script>
@endpush