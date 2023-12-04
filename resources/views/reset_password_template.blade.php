<!doctype html>
<html>

<head>
    <style>
        .reset_pass {
            color: #fff;
            background-color: #556ee6;
            border-color: #556ee6;
            padding: .47rem .75rem;
            font-size: .8125rem;
            border-radius: .25rem;
        }
    </style>
</head>

<body>
    @php
        $id = $user->id;
        $encrypt_id = Crypt::encrypt($id);
    @endphp

    <table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#de137b">

        <!-- START HEADER/BANNER -->
        <tbody>
            <tr>

                <td align="center">
                    <table width="600" border="0" align="center" cellpadding="50" cellspacing="0">
                        <tbody>
                            <tr>
                                <td align="center" valign="top" bgcolor="#ffffff">
                                    <table class="col-600" width="600" height="200" border="0" align="center"
                                        cellpadding="0" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <td height="20"></td>
                                            </tr>
                                            <tr>
                                                <td align="center"
                                                    style="font-family: 'Raleway', sans-serif; font-size:37px; color:#000000; font-weight: bold; margin-bottom: 20;">
                                                    <img height="120"
                                                        src="https://goserver.space/kapitol-health/public/forgot.png"
                                                        alt="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="30"></td>
                                            </tr>
                                            <tr>
                                                <td align="center"
                                                    style="font-family: 'Raleway', sans-serif; font-size:20px; color:#000000; font-weight: bold;">
                                                    <p class=""> Forgot Your Password?</p>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td align="center"
                                                    style="font-family: 'Lato', sans-serif; font-size:15px; color:#000000; line-height:24px; font-weight: 400;">

                                                    <br> Not to worry, we got you! Let's get you a new password.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="40"></td>
                                            </tr>
                                            <tr>
                                                <td align="center"
                                                    style="border-top: 1px solid rgb(168, 168, 168); border-bottom: 1px solid rgb(168, 168, 168); padding:30px">
                                                    <a style="font-family: 'Lato', sans-serif;font-size:15px;  color: #ffffff;line-height:24px;font-weight: 500;background: #000000;padding: 10px 25px;text-decoration: none;border-radius: 5px;"
                                                        href="{{ url('forgot_password/' . $encrypt_id) }}">Reset
                                                        Password</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="30"></td>
                                            </tr>
                                            <tr>
                                                <td align="left"
                                                    style="font-family: 'Lato', sans-serif; text-align: center; font-size:15px; color:#000000; line-height:24px; font-weight: 400;">
                                                    Thankyou
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="10"></td>
                                            </tr>

                                            <tr>
                                                <td height="35"></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>
