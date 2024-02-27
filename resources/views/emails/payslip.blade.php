<!DOCTYPE html>
<html>
    <head>
        @include('emails.layouts.head')
    </head>
<body>
    <!-- header begin -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h2>{{ $params['company_name'] }}</h2>
                <h5 style="font-size: 14px;">{{ $params['address'] }}</h5>
                <h5 style="font-size: 14px;">Phone: {{ $params['phone'] }}</h5>
            </div>
            <div class="col-md-6 text-right">
                <p>Date: {{ $params['date'] }}</p>
                <div class="d-flex justify-content-end">
                    <img src="https://picsum.photos/70/70" alt="Avatar 1" style="width: 70px; height: 70px; border-radius: 50%; margin-left: 10px;">
                    <img src="https://picsum.photos/70/70" alt="Avatar 2" style="width: 70px; height: 70px; border-radius: 50%;">
                </div>
            </div>
        </div>
        
        
        
        
        <hr>
        <div class="row">
            <div class="col-md-6">
                <div style="background-color: #4a84ab; padding: 5px; width: 300px;">
                    <h4 style="color: #fff;">Employee Information</h4>
                </div>
                <br>
                <p><strong>Name: {{ $params[''] }}</strong></p>
                <p><strong>DOB: {{ $params[''] }}</strong></p>
                <p><strong>Rank: {{ $params[''] }}</strong></p>
                <p><strong>Employee ID: {{ $params[''] }}</strong></p>
                <p><strong>Email: {{ $params[''] }}</strong></p>
            </div>

            
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <div class="box">
                            <div class="box-header" style="background-color: #4a84ab; padding: 5px;">
                                <h4 style="color: #fff;" class="text-center">Pay Date</h4>
                            </div>
                            <div class="box-details bg-light">
                                <p>Pay Period: {{ $params[''] }}</p>
                                <!-- <p>Pay Period: October 1 - October 15, 2023</p> -->
                                <!-- <p>Payment Date: October 20, 2023</p> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box">
                            <div class="box-header" style="background-color: #4a84ab; padding: 5px;">
                                <h4 style="color: #fff;" class="text-center">Pay Date</h4>
                            </div>
                            <div class="box-details bg-light">
                                <p>Pay Period: {{ $params[''] }}</p>
                                <!-- <p>Pay Period: October 1 - October 15, 2023</p> -->
                                <!-- <p>Payment Date: October 20, 2023</p> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box">
                            <div class="box-header" style="background-color: #4a84ab; padding: 5px;">
                                <h4 style="color: #fff;" class="text-center">Pay Date</h4>
                            </div>
                            <div class="box-details bg-light">
                                <p>Pay Period: {{ $params[''] }}</p>
                                <!-- <p>Pay Period: October 1 - October 15, 2023</p> -->
                                <!-- <p>Payment Date: October 20, 2023</p> -->
                            </div>
                        </div>
                    </div>
                </div>
                <p><strong>PSN: {{ $params[''] }}</strong></p>
                <!-- <p><strong>PSN: GHF345334</strong></p> -->
                <p><strong>Bank Name: {{ $params[''] }}</strong></p>
                <p><strong>Bank Account Number: {{ $params[''] }}</strong></p>
            </div>
        </div>
    <!-- header end -->
        <table class="table mt-4">
            <thead>
                <tr style="background-color: #cbcbcb; border-top: 2px solid #000;">
                    <th>Basics and Allowance</th>
                    <th>Hours</th>
                    <th>Rate</th>
                    <th>Current</th>
                    <th>YTD</th>
                </tr>
            </thead>               
            <tbody>
                <tr>
                    <td>Basic Salary</td>
                    <td>{{ $params[''] }}</td>
                    <!-- <td>80</td> -->
                    <td>{{ $params[''] }}</td>
                    <!-- <td>₦15/hour</td> -->
                    <td>{{ $params[''] }}</td>
                    <!-- <td>₦1,200.00</td> -->
                    <td>{{ $params[''] }}</td>
                    <!-- <td>₦1,200.00</td> -->
                </tr>
                <tr>
                    <td>Clothing Allowance</td>
                    <td>{{ $params[''] }}</td>
                    <td>{{ $params[''] }}</td>
                    <td>{{ $params[''] }}</td>
                    <td>{{ $params[''] }}</td>
                </tr>
                <tr>
                    <td>Data Allowance</td>
                    <td>{{ $params[''] }}</td>
                    <td>{{ $params[''] }}</td>
                    <td>{{ $params[''] }}</td>
                    <td>{{ $params[''] }}</td>
                </tr>
                <tr>
                    <td>Feeding Allowance</td>
                    <td>{{ $params[''] }}</td>
                    <td>{{ $params[''] }}</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Housing Allowance</td>
                    <td>{{ $params[''] }}</td>
                    <td>{{ $params[''] }}</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Relocation Allowance</td>
                    <td>{{ $params[''] }}</td>
                    <td>{{ $params[''] }}</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <br>
                <tr style="background-color: #cbcbcb;">
                    <td></td>
                    <td></td>
                    <td><strong>GROSS PAY</strong></td>
                    <td><strong>{{ $params[''] }}</strong></td>
                    <!-- <td><strong>₦5,600</strong></td> -->
                    <td><strong>{{ $params[''] }}</strong></td>
                    <!-- <td><strong>₦5,600</strong></td> -->
                </tr>
                
            </tbody>
        </table>


        <!-- deductions -->
        <table class="table mt-4">
            <thead style="display: table; width: 145%;">
                <tr style="background-color: #cbcbcb; border-top: 2px solid #000;">
                    <th>Deductions</th>
                    <th>Value</th>
                </tr>
            </thead>                        
            <tbody>
                <tr>
                    <td>ITF Deduction</td>
                    <td>{{ $params[''] }}</td>
                </tr>
                <tr>
                    <td>NHF Deduction</td>
                    <td>{{ $params[''] }}</td>
                </tr>
                <tr>
                    <td>NHIS Deduction</td>
                    <td>{{ $params[''] }}</td>
                </tr>
                <tr>
                    <td>NSITF Deduction</td>
                    <td>{{ $params[''] }}</td>
                </tr>
                <tr>
                    <td>Pension Deduction</td>
                    <td>{{ $params[''] }}</td>
                </tr>
                <tr>
                    <td>Tax</td>
                    <td>{{ $params[''] }}</td>
                </tr>
                <br>
                <tr style="background-color: #cbcbcb;">
                    <td><strong>TOTAL DEDUCTIONS</strong></td>
                    <td><strong>{{ $params[''] }}</strong></td>
                </tr>
            </tbody>

        </table>
        <!-- end of dedcutions table -->
        <hr>
        <br>
        <div class="row mt-3">
            <div class="col-md-6 offset-md-6 text-right">
                <table class="table">
                    <tbody>
                        <tr style="background-color: #cbcbcb; border-top: 2px solid #000; border-bottom: 2px solid #000;">
                            <td><strong>NET PAY</strong></td>
                            <td><strong>{{ $params[''] }}</strong></td>
                            <td><strong>{{ $params[''] }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!-- Footer Notes -->
    <div class="row mt-3 py-3">
        <div class="col-md-12 text-center">
            <p class="font-weight-bold">If you have any questions about this payslip, please contact admin</p>
        </div>
    </div>

    @include('emails.layouts.footer')

</body>
</html>
