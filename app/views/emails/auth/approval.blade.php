<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>User Approval</h2>

        <div>
            An account has been registered at {{ URL }}.<br />
            <table>
                <thead>
                    <tr>
                        @foreach($user as $field => $value)
                        <th>{{ studly_case($field) }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach($user as $field => $value)
                        <th>{{ $value }}</th>
                        @endforeach
                    </tr>
                </tbody>
                <caption>User's info</caption>
            </table>
            Please follow this <a href="{{ URL.'/admin/users/active-account/'.$token }}" target="_blank">link</a> to active this account.
        </div>
    </body>
</html>
