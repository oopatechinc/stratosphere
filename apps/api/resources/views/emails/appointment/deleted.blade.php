<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark">
    <meta name="supported-color-schemes" content="light dark">
    <title>Email Template 1</title>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap');
        table {
            border-spacing: 0;
        }
        td {
            padding: 0;
        }
        p {
            font-size: 15px;
        }
        img {
            border: 0;
            border-width:0;
        }
        a {
            color: #277fd2;
            text-decoration: none;
        }
        @media screen and (max-width: 599.98px) {
            .px-600-0 {
                padding-left: 0!important;
                padding-right: 0!important;
            }
            .pt-600-0 {
                padding-top: 0!important;
            }
            img.third-img-last {
                width: 200px!important;
                max-width: 200px!important;
            }
            .d-600-none {
                display: none!important;
            }
            .pr-large {
                padding-right: 140px!important;
            }
            .center-text-mobile {
                text-align: center!important;
            }
        }
        @media screen and (max-width: 549.98px) {
            .pt-550-0 {
                padding-top: 0!important;
            }
            .pr-large {
                padding-right: 100px!important;
            }
        }
        @media screen and (max-width: 499.98px) {
            .pt-500-0 {
                padding-top: 0!important;
            }
            .pr-large {
                padding-right: 60px!important;
            }
        }
        @media screen and (max-width: 399.98px) {
            .banner {
                height: auto!important;
                padding-top: 50px!important;
                padding-bottom: 30px!important;
            }
            .px-sm-0 {
                padding-left: 0!important;
                padding-right: 0!important;
            }
            .pt-400-0 {
                padding-top: 0!important;
            }
            img.third-img {
                width: 200px!important;
                max-width: 200px!important;
            }
            .pr-large {
                padding-right: 25px!important;
            }
        }

        /* Custom Dark Mode Colors */
        :root {
            color-scheme: light dark;
            supported-color-schemes: light dark;
        }
        @media (prefers-color-scheme: dark) {
            body, center, table, .darkmode-bg {
                background: #2d2d2d!important;
                color: #ffffff!important;
            }
            .darkmode-transparent {
                background-color: transparent!important;
            }
        }
    </style>

    <!--[if (gte mso 9)|(IE)]>
    <style type="text/css">
        table {border-collapse: collapse !important;}
    </style>
    <![endif]-->

</head>
<body style="Margin:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-width:100%;background-color:#F6F9FC;">

<!--[if (gte mso 9)|(IE)]>
<style type="text/css">
    body {background-color: #F6F9FC!important;}
    body, table, td, p, a {font-family: sans-serif, Arial, Helvetica!important;}
</style>
<![endif]-->

<center style="width: 100%;table-layout:fixed;background-color: #F6F9FC;padding-bottom: 40px;">
    <div style="max-width: 600px;background-color: #ffffff;box-shadow: 0 0 10px rgba(0, 0, 0, .2);">

        <div style="font-size: 0px;color: #fafdfe;line-height: 1px;mso-line-height-rule:exactly;display: none;max-width: 0px;max-height: 0px;opacity: 0;overflow: hidden;mso-hide:all;">
            Your Appointment Confirmation From {{config('app.name')}}
        </div>

        <!--[if (gte mso 9)|(IE)]>
        <table width="600" align="center" style="border-spacing:0;color:#3d3d3d;" role="presentation">
            <tr>
                <td style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;">
        <![endif]-->

        <table align="center" style="border-spacing:0;color:#3D3D3D;font-family: 'Lato',sans-serif, Arial, Helvetica;background-color: #ffffff;Margin:0;padding-top: 0;padding-right: 0;padding-bottom: 0;padding-left: 0;width: 100%;max-width: 600px;" role="presentation">

            <tr>
                <td style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;">
                    <table width="100%" style="border-spacing:0;" role="presentation">

                        <tr>
                            <td style="background-color:#277fd2;padding-top:10px;padding-bottom:8px;width:100%;width:600px;text-align:center;">
                                <a href="{{config('app.urls.admin_url')}}"><img src="https://bookisia-public.s3.ca-central-1.amazonaws.com/images/emails/logo-white.png" alt="logo" width="180" style="border-width:0;" border="0"></a>
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>

            <tr>
                <td style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;">
                    <table width="100%" style="border-spacing:0;text-align: left" role="presentation">
                        <tr>
                            <td style="padding-top:22px;padding-right:20px;padding-bottom:5px;padding-left:20px;width:100%;text-align:left;font-size:20px;">
                                <p style=" font-size:20px; font-weight:bold; padding-bottom: 5px;text-align: left">
                                    <strong style="color: #277fd2;">Appointment Deleted</strong>
                                </p>
                                <p style="font-size:15px; line-height: 23px; padding-bottom: 5px;">{{$message}}</p>
                                <p style="font-size:15px; line-height: 23px; padding-bottom: 5px;"><strong>Date: </strong>{{$date}}</p>
                                <p style="font-size:15px; line-height: 23px; padding-bottom: 5px;"><strong>Time: </strong>{{$startTime}}</p>
                                <p style="font-size:15px; line-height: 23px; padding-bottom: 8px;"><strong>Services: </strong>{{$services}}</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;">
                    <table width="100%" style="border-spacing:0;text-align: center" role="presentation">
                        <tr>
                            <td class="padding content" style="background-color:#252c3f;color:#ffffff;font-size:16px;padding-top:20px;padding-right:20px;padding-bottom:20px;padding-left:20px;width:100%;text-align:center; width:600px;">
                                <p style="font-size:14px;line-height: 5px;text-align:left">To avoid loss of revenue, this business has a 24-hours cancellation policy.</p>
                                <p style="font-size:14px;line-height: 5px;padding-bottom: 5px;text-align:left">If you can't make your appointment, please <a href="{{config('app.urls.client_url')}}/appointments" target="_blank"><strong>cancel</strong></a> or <a href="{{config('app.urls.client_url')}}/appointments" target="_blank"><strong>reschedule</strong></a> to avoid charges.</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;">
                    <table width="100%" style="border-spacing: 0;" role="presentation">
                        <tr>
                            <td height="5" style="background-color: #277fd2;"></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td class="container" background="https://bookisia-public.s3.ca-central-1.amazonaws.com/images/emails/email-support-white-bg.png" width="600" height="255" style="background-position: center top;">

                    <!--[if (gte mso 9)|(IE)]>
                    <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:600px;height:255px;">
                        <v:fill type="tile" src="https://bookisia-public.s3.ca-central-1.amazonaws.com/images/emails/email-support-white-bg.png" color="#ffffff" />
                        <v:textbox inset="0,0,0,0">
                    <![endif]-->

                    <table class="darkmode-transparent" cellpadding="0" cellspacing="0" role="presentation">
                        <tr>
                            <td width="600" height="100" align="center" valign="top">
                                <table class="darkmode-transparent" cellpadding="0" cellspacing="0" role="presentation">
                                    <tr>
                                        <td align="center">
                                            <table class="darkmode-transparent" role="presentation">
                                                <tr>

                                                    <!--[if (gte mso 9)|(IE)]>
                                                    <td style="padding-top:70px;"></td>
                                                    <![endif]-->

                                                    <td valign="top" align="center" style="padding-right:15px;padding-left:15px; vertical-align:middle;">

                                                        <p style="font-size: 22px; line-height: 26px; font-weight:bold; color: #3d3d3d;text-align:center">Need Some Assistance?</p>

                                                        <p align="center" style="font-size:16px;line-height: 18px;color: #3d3d3d;text-align:center">Our businesses are always happy to help their customers.</p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <table class="darkmode-transparent" align="center" width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
                                                <tr>

                                                    <!--[if (gte mso 9)|(IE)]>
                                                    <td style="padding-top:20px;"></td>
                                                    <![endif]-->

                                                    <td align="center" style="padding-top: 15px;">
                                                        <table class="darkmode-transparent" border="0" cellspacing="0" cellpadding="0" role="presentation">
                                                            <tr>

                                                                <td align="center" style="border-radius:4px;" bgcolor="#277fd2">
                                                                    <a href="{{$businessPhone}}" style="font-size: 16px;font-weight: bold;text-decoration: none;color: #ffffff;background-color: #277fd2;border:1px solid #277fd2;border-radius:4px;padding:10px 15px;display: inline-block;">Call Business
                                                                    </a>
                                                                </td>

                                                                <td align="center" width="18"></td>

                                                                <td align="center" style="border-radius:4px;" bgcolor="#2cbc8c">
                                                                    <a href="{{$businessEmail}}" style="font-size: 16px;font-weight: bold;text-decoration: none;color: #ffffff;background-color: #2cbc8c;border:1px solid #2cbc8c;border-radius:4px;padding:10px 15px;display: inline-block;">Send Email
                                                                    </a>
                                                                </td>

                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height="20"> </td>
                        </tr>
                    </table>

                    <!--[if (gte mso 9)|(IE)]>
                    </v:textbox>
                    </v:rect>
                    <![endif]-->

                </td>
            </tr>

            <tr>
                <td style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;">
                    <table width="100%" style="border-spacing:0;" role="presentation">
                        <tr>
                            <td class="padding content" style="background-color:#277fd2;color:#ffffff;font-size:16px;padding-top:10px;padding-right:20px;padding-bottom:20px;padding-left:20px;width:100%;text-align:center; width:600px;">
                                <p style="font-size:18px;line-height: 35px;padding-bottom: 5px;text-align:center">Connect with us</p>
                                <a href="https://www.facebook.com/bookisia" target="_blank"><img src="https://bookisia-public.s3.ca-central-1.amazonaws.com/images/emails/white-facebook.png" alt="footer facebook" width="30" style="border-width:0;"></a>
                                <a href="https://twitter.com/bookisia" target="_blank"><img src="https://bookisia-public.s3.ca-central-1.amazonaws.com/images/emails/white-twitter.png" alt="footer twitter" width="30" style="border-width:0;"></a>
                                <a href="https://www.linkedin.com/company/bookisia/" target="_blank"><img src="https://bookisia-public.s3.ca-central-1.amazonaws.com/images/emails/white-linkedin.png" alt="footer linkedin" width="30" style="border-width:0;"></a>
                                <a href="https://www.instagram.com/bookisia" target="_blank"><img src="https://bookisia-public.s3.ca-central-1.amazonaws.com/images/emails/white-instagram.png" alt="footer instagram" width="30" style="border-width:0;"></a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td style="background-color:#efefef;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;text-align:center;">
                    <table width="100%" style="border-spacing:0;" role="presentation">
                        <tr>
                            <td class="padding content" style="font-size:13px;padding-top:45px;padding-right:20px;padding-bottom:10px;padding-left:20px;width:100%;text-align:center; width:600px;">
                                <a href="{{config('app.urls.client_url')}}"><img src="https://bookisia-public.s3.ca-central-1.amazonaws.com/images/emails/logo-blue.png" alt="" width="150" style="border-width:0;"></a>
                                <p style="font-size:15px;text-decoration:none;text-align: center">A Proudly Canadian Company</p>
                                <p style="text-align: center"><a style="font-size:13px; color:#277fd2;text-decoration:none;" href="mailto:{{config('platform.support.email')}}">{{config('platform.support.email')}}</a></p>
                                <p style="text-align: center"><a style="font-size:13px; color:#277fd2;text-decoration:none;" href="tel:{{config('platform.support.phone')}}">{{config('platform.support.phone')}}</a></p>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" width="100%" height="20" style="background-color:#277fd2;">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->

    </div>
</center>
</body>
</html>
