@extends('layouts.mail')

@section('title', __('Confirm password'))
@section('description', __('Confirm password'))

@section('content')
<tr>
    <td style="padding: 30px 30px 15px 30px;">
        <h2 style="font-size: 18px; color: #6576ff; font-weight: 600; margin: 0;">{{ __('Confirm your email address') }}</h2>
    </td>
</tr>
<tr>
    <td style="padding: 0 30px 20px">
        <p style="margin-bottom: 10px;">{{ __('Hello,') }}</p>
        <p style="margin-bottom: 10px;">{{ __('anonymous!') }}</p>
        <p style="margin-bottom: 10px;">{{ __('To complete registration, please go to') }}</p>
        <p style="margin-bottom: 10px;text-align:center;">
            <a href="{{ $url }}" style="background-color:#6576ff;border-radius:4px;color:#ffffff;display:inline-block;font-size:13px;font-weight:600;line-height:44px;text-align:center;text-decoration:none;text-transform: uppercase; padding: 0 30px">{{ __('link') }}</a>
        </p>
        <p style="margin-bottom: 10px;">{{ __('Share honest reviews and impressions on the website') }} {{ config('app.name', 'Отзовик') }}.</p>
        <p style="margin-bottom: 10px;">{{ __('After authorization, you will have access to all the functions of the service.') }}</p>
        <p style="margin-bottom: 10px;">{{ __('To contact us, please use the feedback form.') }}</p>
        <p style="margin-bottom: 25px;">{{ __('Sincerely, Administration') }} {{ config('app.name') }}.</p>
    </td>
</tr>
<tr>
    <td style="padding: 0 30px">
        <h4 style="font-size: 15px; color: #000000; font-weight: 600; margin: 0; text-transform: uppercase; margin-bottom: 10px">{{ __('or') }}</h4>
        <p style="margin-bottom: 10px;">{{ __('If the button above doesnt work, paste this link into your browser:') }}</p>
        <a href="{{ $url }}" style="color: #6576ff; text-decoration:none;word-break: break-all;">{{ $url }}</a>
    </td>
</tr>

@endsection