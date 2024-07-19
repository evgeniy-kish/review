<?php
/**
 * @var string $route
 */

?>
<div class="contact-area">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(auth()->check() && auth()->user()->hasVerifiedEmail())
        <h4 class="mb-5">{{ __('Leave comment') }}</h4>
        <form id="comment-form" class="contact-from" action="{{ $route }}" method="post">
            @csrf
            <div class="row">
                <div class="col-12">
                    <!--suppress HtmlFormInputWithoutLabel -->
                    <textarea class="form-control mb-30" name="message" placeholder="{{ __('Comment text...') }}" required></textarea>
                </div>
                <div class="col-12">
                    <button class="btn saasbox-btn" type="submit">{{ __('Send') }}</button>
                </div>
            </div>
        </form>
    @else
        <p class="alert alert-warning">
            {{ __('To leave a comment you need') }}
            @if(!auth()->check())
                <a href="{{ route('login') }}">{{ __('Login') }}</a>
                {{ __('or') }}
                <a href="{{ route('register') }}">{{ __('Register') }}</a>
            @else
                {{ __('confirm your email') }}
            @endif
        </p>
    @endif
</div>