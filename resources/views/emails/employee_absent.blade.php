<!DOCTYPE html>
<html lang="en">

<head>
    @include('emails.layouts.head')
</head>

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
                                                    <p>Dear Admin,</p>
                                                    <p><strong>Employees who missed clocking in:</strong></p>

                                                    @foreach($params['employee_details'] as $employee)
                                                    <p>- {{ $employee->fullname }} (Employee Phone: <strong>{{ $employee->mobile_phone }}</strong>)</p>
                                                    @endforeach

                                                    <p>Please take necessary actions to address this issue.</p>

                                                    <p>Thank you.</p>
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