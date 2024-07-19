@extends('layouts.mail')

@section('title', __('Reset the password'))
@section('description', __('Reset the password'))

@section('content')
<tr>
    <td style="text-align:center;padding: 30px 30px 15px 30px;">
        <h2 style="font-size: 18px; color: #6576ff; font-weight: 600; margin: 0;">{{ __('Password reset') }}</h2>
    </td>
</tr>
<tr>
    <td style="text-align:center;padding: 0 30px 20px">
        <p style="margin-bottom: 10px;">{{ __('Hello,') }} {{ $user->name }}!</p>
        <p style="margin-bottom: 10px;">{{ __('You have changed your login information') }} {{ config('app.name') }}. {{ __('Go to') }}</p>
        <p style="margin-bottom: 10px;text-align:center;">
            <a href="{{ $url }}" style="background-color:#6576ff;border-radius:4px;color:#ffffff;display:inline-block;font-size:13px;font-weight:600;line-height:44px;text-align:center;text-decoration:none;text-transform: uppercase; padding: 0 25px">{{ __('link') }}</a>
        </p>
        <p style="margin-bottom: 10px;">{{ __('to reset your password.') }}</p>
        <p style="margin-bottom: 10px;">{{ __('Note! If you have not changed your personal data on the website, do not use the above link and contact technical support right now. To contact us, please use the feedback form.') }}</p>
        <p style="margin-bottom: 25px;">{{ __('Sincerely, Administration') }} {{ config('app.name') }}.</p>
    </td>
</tr>
@endsection
