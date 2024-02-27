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
                            <p><strong>Your password has been successfully reset automatically by the system on  {{ \Carbon\Carbon::now()->format('l jS \\of F Y h:i:s A') }} </strong></p>
                            <p>Your new password is {{ $params['Password'] }},</p>
                            <p>This is due to your password expiry date set for 60days. Please kindly go and change this default password to your preferred password</p>
                            <p>Alternatively, chat us via whatsapp on the above number or send an email to info@smartpayment.com.ng.</p>
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