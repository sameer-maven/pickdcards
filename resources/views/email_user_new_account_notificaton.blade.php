<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Welcome to PickdCards</title>
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
                <img src="assets/logo.png" alt="" style="width:100%; max-width:180px;">
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
                    "> <span style="
                    font-weight: 600;
                    font-size: 22px;
                    "> Hi {{ $data->name }}, </span><br>
                    We're excited to have you get started with PickdCards.
                    Please confirm your email by pressing the below button and get started with us.
                </p>
                <div style="
                    text-align: center;
                    ">
                    <a href="{{ url('/') }}" style="font-size: 25px;padding: 0;text-align: center;background: #DE5246;padding: 11px 40px;color: #fff;text-decoration: none;border-radius: 70px;display: inline-block;margin-top: 10px;">Confirm</a>
                </div>
                <div>
                    <p style="margin-top: 50px;padding-top: 20px;border-top: 1px solid #0000001a;font-size: 20px;color: #2F3B49;"> 
                        If you have any question or concern, We're here to help.
                    </p>
                    <a href="#" style="
                        font-size: 20px;
                        color: #2F3B49;
                        text-decoration: underline;
                        ">Contact Us</a>
                    <p style="
                        padding-top: 30px;
                        font-size: 20px;
                        ">The Pickd cards Team</p>
                </div>
            </div>
        </div>
        <div style="line-height:1.4;font-family: sans-serif;box-sizing: content-box;-webkit-box-sizing: content-box;margin: 0;background: #fff;margin-top: -30px;border-radius: 50px 50px 0px 0px;">
            <div style="max-width: 600px;margin:auto;background: #fff;margin-top: -50px;padding: 30px 40px;border-radius: 15px 15px 0px 0px;">
                <table style="width: 100%;">
                    <tbody>
                        <tr>
                            <td style="text-align: left;">
                                <img src="assets/logo.png" alt="" style="
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