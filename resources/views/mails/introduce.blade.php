<?php

/**
 * @var \Illuminate\Http\Request $request
 */

?>
<table>
    <tr>
        <td>{{ __('User name') }}</td>
        <td>{{ $request->user()->name }}</td>
    </tr>
    <tr>
        <td>Email</td>
        <td>{{ $request['email'] }}</td>
    </tr>
    <tr>
        <td>{{ __('Message') }}</td>
        <td>{{ $request['message'] }}</td>
    </tr>
</table>
