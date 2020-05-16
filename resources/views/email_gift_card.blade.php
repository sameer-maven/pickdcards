<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title></title>
   </head>
   <body style="margin: 0 auto;">
      <div>
         <table width="600" style="margin: 0 auto;">
            <tbody>
               <tr>
                  <td width="100%" style="background-image: url({{$mainbgImg}});">
                     <table width="100%">
                        <tbody>
                           <tr>
                              <td align="center">
                                 <img src="{{$data['avatar']}}" alt="" width="100" height="100" style="max-width: 100%;">
                              </td>
                           </tr>
                           <tr>
                              <td style="padding-top: 40px; padding-bottom: 40px;">
                                 <table width="100%" style="    border: 5px solid #FECA5C;
                                    border-radius: 40px;
                                    padding: 20px 30px 30px;background-color: #fff;width: 490px;
                                    margin: 0 auto;">
                                    <tbody>
                                       <tr>
                                          <td>
                                             <h1 style="font-size: 38px;font-weight: 700;color: #4B4B4B">Hello {{$data['customer_name']}}!</h1>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <table width="100%" style="background-image: url({{$bgImg}}); background-repeat: no-repeat; background-size: cover; min-height: 220px;background-color: #e3eef2;">
                                                <tbody>
                                                   <tr>
                                                      <td width="40%">
                                                      </td>
                                                      <td width="60%">
                                                         <table>
                                                            <tbody>
                                                               <tr>
                                                                  <td style="font-size: 14px;color: #4B4B4B;padding: 7px;">It’s a gift card</td>
                                                               </tr>
                                                               <tr>
                                                                  <td style="    font-size: 24px;color: #4B4B4B;padding: 7px;">$ {{$data['balance']}} GIFT CARD</td>
                                                               </tr>
                                                               <tr>
                                                                  <td style="font-size: 14px;color: #4B4B4B;line-height: 26px;">
                                                                     You can use the card during your Purchase!
                                                                  </td>
                                                               </tr>
                                                            </tbody>
                                                         </table>
                                                      </td>
                                                   </tr>
                                                </tbody>
                                             </table>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td style="font-size: 15px;color: #606060;padding-top: 10px;padding-bottom: 10px;">Thank you for being with us.</td>
                                       </tr>
                                       <tr>
                                          <td align="center" style="padding-top: 30px;">
                                             <h2 style="font-size: 25px; color: #4B4B4B;">Here's your unique QR code</h2>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td align="center">
                                             <img src="{{$data['qrcode']}}" style="max-width: 100%;">
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </td>
               </tr>
               <tr>
                  <td>
                     <table width="100%" style="background-color: #FECA5C;padding: 20px;">
                        <tbody>
                           <tr>
                              <td>
                                 <img src="{{$footerLogoImg}}" style="max-width: 100%;">
                              </td>
                           </tr>
                           <tr>
                              <td style="color: #2F3B49;font-size: 15px;">
                                 If you've any question or concern, we're here to help. contact us via our help centre.
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
   </body>
</html>