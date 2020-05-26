<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>New User Registered</title>
        <style>
            * { 
            box-sizing: content-box;
            -webkit-box-sizing: content-box;
            margin: 0;
            }
        </style>
    </head>
    <body style="line-height:1.4;font-family: sans-serif; box-sizing: content-box;-webkit-box-sizing: content-box;margin: 0;">
        <div style="line-height:1.4;font-family: sans-serif; box-sizing: content-box;-webkit-box-sizing: content-box;margin: 0; background: #EAECEB;">
            <div style="margin:auto;text-align: center;padding: 30px 30px 100px;">
                <img src="{{ asset('public/front/assets/email/logo.png') }}" alt="" style="width:100%; max-width:180px;">
            </div>
        </div>
        <div style="line-height:1.4;font-family: sans-serif;box-sizing: content-box;-webkit-box-sizing: content-box;margin: 0;background: #2F3B49;padding: 0 0 40px;">
            <div style="
                max-width: 600px;
                margin: auto;
                background-color: #fff;
                border-radius: 15px;
                padding: 39px;
                text-align: left;
                position: relative;
                top: -75px;
                ">
                <h2 style="font-size: 35px;padding: 20px 0 35px;text-align: center;font-weight: 600;color: #2F3B49;">Welcome To Pickd Cards !</h2>
                <p style="
                    font-size: 20px;
                    color: #2F3B49;
                    "> New user has been registered with the Pickd Cards!<br>
                </p>
                <p style="
                    font-size: 20px;
                    color: #2F3B49;
                    ">
                    Business Name- {{ $data->business_name }}
                    Email- {{ $data->email }}
                </p>
                <p style="
                    font-size: 20px;
                    color: #2F3B49;
                    ">
                    Account activation is required for user to start receiving the payments. You must manually verify their account.
                </p>
                <p style="
                    font-size: 20px;
                    color: #2F3B49;
                    ">
                    Manage User verification- User Management >> Business User >> Action >> Edit >> Verify.
                </p>
            </div>
        </div>
        <div style="line-height:1.4;font-family: sans-serif;box-sizing: content-box;-webkit-box-sizing: content-box;margin: 0;background: #fff;margin-top: -30px;border-radius: 50px 50px 0px 0px;">
            <div style="max-width: 600px;margin:auto;background: #fff;margin-top: -50px;padding: 30px 40px;border-radius: 15px 15px 0px 0px;">
                <table style="width: 100%;">
                    <tbody>
                        <tr>
                            <td style="text-align: left;">
                                <img src="{{ asset('public/front/assets/email/logo.png') }}" alt="" style="
                                    width: 129px;
                                    ">
                            </td>
                            <td style="text-align: right;">
                                <ul style="list-style: none; display: block;padding: 0;">
                                    <ii style="display: inline-block;">
                                        <a style="display: inline-block;" href="#">
                                        <img src="{{ asset('public/front/assets/email/fb.png') }}" alt="">
                                        </a>
                                    </ii>
                                    <ii style="display: inline-block;">
                                        <a style="display: inline-block;" href="#">
                                        <img src="{{ asset('public/front/assets/email/in.png') }}" alt="">
                                        </a>
                                    </ii>
                                    <ii style="display: inline-block;">
                                        <a style="display: inline-block;" href="#">
                                        <img src="{{ asset('public/front/assets/email/ins.png') }}" alt="">
                                        </a>
                                    </ii>
                                    <ii style="display: inline-block;">
                                        <a style="display: inline-block;" href="#">
                                        <img src="{{ asset('public/front/assets/email/pr.png') }}" alt="">
                                        </a>
                                    </ii>
                                    <ii style="display: inline-block;">
                                        <a style="display: inline-block;" href="#">
                                        <img src="{{ asset('public/front/assets/email/tw.png') }}" alt="">
                                        </a>
                                    </ii>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>