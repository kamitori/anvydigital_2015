<table width="100%" style="text-align:center;">
    <tr>
        <td>
            <table width="70%" style="font-family:arial;margin:auto;">
                <tr>
                    <th style="font-size:24px;background-color:#99CCFF;font-weight:bold;color:#282828;padding:30px;text-align:center;border:double 4px #999;">You Have Received A Message From: </th>
                </tr>
                <tr>
                    <td>
                        <br/>
                        <b style="font-size:16px;color:#000000;">{{ $feedback['first_name'] }} {{ $feedback['last_name'] }}</b>
                        <br/> <b>Reply to:</b> [{{ $feedback['email'] }}].
                        <br />
                        <b>Phone:</b> {{ $feedback['phone'] }}
                        <br /> @if (!empty($feedback['company'])) <b>Company:</b>{{ $feedback['company'] }}
                        <br /> @endif
                        <hr />
                        <br/> {{ $feedback['message'] }}
                        <br/>
                        <br/>
                        <hr/>
                        <p style="font-size:13px;">This message was sent using the Anvy Digital contact form.</p>
                    </td>
            </table>
        </td>
    </tr>
</table>
