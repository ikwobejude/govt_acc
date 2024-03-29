<!DOCTYPE html>
<html lang="en">
  <head>
    @include('emails.layouts.head')
  </head>

<!-- body start -->

<body>
  <body style="margin: 30px auto;">
    <table style="width: 100%">
      <tbody>
        <tr>
          <td>
            <table style="background-color: #f6f7fb; width: 100%">
              <tbody>
                <tr>
                  <td>
                    <table style="width: 650px; margin: 0 auto; margin-bottom: 30px">
                      <tbody>
                        <tr>
                          <td><img src="{{ asset('/backend/assets/images/smartpay.png') }}" alt="" style="width: 100px; height:100px"></td>
                          <td style="text-align: right; color:#999"><span>{{ $params['body'] }}</span></td>
                        </tr>
                      </tbody>
                    </table>
                    <table style="width: 650px; margin: 0 auto; background-color: #fff; border-radius: 8px">
                      <tbody>
                        <tr>
                          <td style="padding: 30px"> 
                            <p>Dear  {{ $params['Name'] }},</p>
                            <p><strong>You’re almost ready to start enjoying SmartPay </strong></p>
                            <p>Simply click the big button below to verify your email address.</p>
                            <a href="{{ $params['url'] }}" style="padding: 10px; background-color: #24695c; color: #ffffff; display: inline-block; border-radius: 4px; margin-bottom: 18px">Verify email </a> 
                            {{-- <p>Alternatively, chat us via whatsapp on the above number or send an email to info@smartpayment.com.ng.</p> --}}
                            <p style="margin-bottom: 0">Warm regards.</p>
                          </td>
                        </tr>
                      </tbody>
                    </table>

                    @include('emails.layouts.footer')
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