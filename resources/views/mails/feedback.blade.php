<?php

/**
 * @var \Illuminate\Http\Request $request
 */

?>
<table>
    <tr>
        <td>{{ __('User name') }}</td>
        <td>{{ $request['name'] }}</td>
    </tr>
    <tr>
        <td>Email</td>
        <td>{{ $request['email'] }}</td>
    </tr>
    <tr>
        <td>Тема</td>
        <td>{{ $request['subject'] }}</td>
    </tr>
    <tr>
        <td>{{ __('Message') }}</td>
        <td>{{ $request['message'] }}</td>
    </tr>
</table>
