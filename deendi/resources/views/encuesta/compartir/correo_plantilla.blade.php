<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="format-detection" content="date=no" />
    <meta name="format-detection" content="address=no" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="x-apple-disable-message-reformatting" />
    <!--[if !mso]><!-->
    <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,700,700i" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico')}}" type="image/x-icon">
    <!--<![endif]-->
    <title>Responder encuesta</title>
      

    <style type="text/css" media="screen">
        /* Linked Styles */
        body { padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#001736; -webkit-text-size-adjust:none }
        a { color:#66c7ff; text-decoration:none }
        p { padding:0 !important; margin:0 !important } 
        img { -ms-interpolation-mode: bicubic; /* Allow smoother rendering of resized image in Internet Explorer */ }
        .mcnPreviewText { display: none !important; }

                
        /* Mobile styles */
        @media only screen and (max-device-width: 480px), only screen and (max-width: 480px) {
            .mobile-shell { width: 100% !important; min-width: 100% !important; }
            
            .text-header,
            .m-center { text-align: center !important; }
            
            .center { margin: 0 auto !important; }
            .container { padding: 20px 10px !important }
            
            .td { width: 100% !important; min-width: 100% !important; }

            .m-br-15 { height: 15px !important; }
            .p30-15 { padding: 30px 15px !important; }

            .m-td,
            .m-hide { display: none !important; width: 0 !important; height: 0 !important; font-size: 0 !important; line-height: 0 !important; min-height: 0 !important; }

            .m-block { display: block !important; }

            .fluid-img img { width: 100% !important; max-width: 100% !important; height: auto !important; }

            .column,
            .column-top,
            .column-empty,
            .column-empty2,
            .column-dir-top { float: left !important; width: 100% !important; display: block !important; }

            .column-empty { padding-bottom: 10px !important; }
            .column-empty2 { padding-bottom: 30px !important; }

            .content-spacing { width: 15px !important; }
        }
    </style>
</head>
<body class="body" style="padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#fff; -webkit-text-size-adjust:none;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f2f2f2">
        <tr>
            <td align="center" valign="top">
                <table width="650" border="0" cellspacing="0" cellpadding="0" class="mobile-shell">
                    <tr>
                        <td class="td container" style="width:650px; min-width:650px; font-size:0pt; line-height:0pt; margin:0; font-weight:normal; padding:3px 0px;">
                            <!-- Header -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td class="p30-15" style="padding: 0px 30px 30px 30px;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <th class="column-top" width="145" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top;">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td class="img m-center" style="font-size:0pt; line-height:0pt; text-align:left;"><img src="{{ asset('img/logo.png')}}" width="70"  editable="true" border="0" alt="" />
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </th>
                                                <th class="column-empty" width="1" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top;"></th>
                                                <th class="column" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal;">
                                                    
                                                </th>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <!-- END Header -->

                            <repeater>
                                <!-- Article Secondary / Image On The Left - Copy On The Right -->
                                <layout label='Article Secondary / Image On The Left - Copy On The Right'>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td class="p30-15" bgcolor="#12325c">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align: center; padding: 30px;">
                                                    <tr>
                                                        <th class="column-empty2" width="30" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top;"></th>
                                                        <th class="column" width="280" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal;">
                                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                    <td class="h4 pb20" style="color:#ffffff; font-family:'Muli', Arial,sans-serif; font-size:20px; line-height:28px; text-align:left; padding-bottom:20px;"><multiline>{{ config('app.name', 'Laravel') }}<ultiline></td>
                                                                </tr>
                                                                
                                                                <tr>
                                                                    <td class="text pb20" style="color:#ffffff; font-family:Arial,sans-serif; font-size:14px; line-height:26px; text-align:left; padding-bottom:20px;"><multiline>Nuestro usuario con correo <strong>{{$contacto['correo_remitente']}}</strong> le ha solicitado que responda la siguiente encuesta:</multiline></td>
                                                                </tr>
                                                                
                                                                <tr>
                                                                    <td class="h4 pb20" style="color:#ffffff; font-family:'Muli', Arial,sans-serif; font-size:20px; line-height:28px; text-align:left; padding-bottom:20px;"><multiline> {{$contacto['encuesta']}}<ultiline></td>
                                                                </tr>
                                                                
                                                                <tr>
                                                                    <td class="h4 pb20" style="color:#ffffff; font-family:'Muli', Arial,sans-serif; font-size:20px; line-height:28px; text-align:left; padding-bottom:20px;"><multiline>Asunto:<ultiline></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text pb20" style="color:#ffffff; font-family:Arial,sans-serif; font-size:14px; line-height:26px; text-align:left; padding-bottom:20px;"><multiline>{{$contacto['asunto']}}</multiline></td>
                                                                </tr>
                                                                
                                                                
                                                                <!-- Button -->
                                                                <tr>
                                                                    <td align="left">
                                                                        <table border="0" cellspacing="0" cellpadding="0">
                                                                            <tr>
                                                                                <td class="dark-blue-button3 text-button" style="background:#021a3d; color:#c1cddc; font-family:'Muli', Arial,sans-serif; font-size:14px; line-height:18px; padding:12px 30px; text-align:center; border-radius:0px 22px 22px 22px; font-weight:bold;"><multiline><a 
                                                                                href="{{route('showEncuestaEmail', encrypt($contacto['id_encuesta']) )}}" target="_blank" class="link-white" style="color:#66c7ff; text-decoration:none;"><span class="link-white" style="color:#ffffff; text-decoration:none;">RESPONDER ENCUESTA</span></a></multiline></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <!-- END Button -->
                                                            </table>
                                                        </th>
                                                        <th class="m-td" width="30" style="font-size:0pt; line-height:0pt; text-align:left;"></th>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="img pb10" style="font-size:0pt; line-height:0pt; text-align:left; padding-bottom:10px;"></td>
                                        </tr>
                                    </table>
                                </layout>
                                
                            <!-- Footer -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td class="p30-15 bbrr" style="padding: 50px 30px; border-radius:0px 0px 26px 26px;" bgcolor="#0e264b">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                
                                            </tr>
                                            <tr>
                                                <td class="text-footer1 pb10" style="color:#c1cddc; font-family:'Muli', Arial,sans-serif; font-size:16px; line-height:20px; text-align:center; padding-bottom:10px;"><multiline>Desarrollo de encuestas dinámicas</multiline></td>
                                            </tr>
                                            <tr>
                                                <td class="text-footer2" style="color:#8297b3; font-family:'Muli', Arial,sans-serif; font-size:12px; line-height:26px; text-align:center;"><multiline></multiline></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <!-- END Footer -->
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
