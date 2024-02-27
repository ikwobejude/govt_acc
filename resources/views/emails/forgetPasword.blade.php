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
                            <p>Hi {{ $params['name']}}, You recently requested to reset the password for your SmartApps account. Kindly use the below password to login and reset your password. </p>
                            <blockquote>Password: {{ $params['password']}}</blockquote> 
                            <p>If you did not request a password reset, please ignore this email or reply to let us know..</p>
                            <p style="margin-bottom: 0">Thank you.</p>
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