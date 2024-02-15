<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voucher</title>

    <style>
        @media print {
            main {
                width: 100%; padding: 0 2rem ; background-color: rgb(220, 220, 220) !important;
            }
        }
    </style>
</head>

<body style="">
    <button onclick="printDiv('invoice')" class="btn btn-primary">Print</button>
    <div id="invoice">
        <main
            style="width: 80%; margin: 0 auto ; padding: 0 2rem ; border: 1px solid gray; background-color: rgb(220, 220, 220);">


            <header style="display: flex; align-items: center; margin-top: 1rem; margin-bottom: 3rem;">
                <div style="width: 25%; padding: 0;">
                    <img style="width: 200px; height: 200px; border-radius: 50%;" src="{{ asset('logo.png') }}"
                        alt="bro jo">
                </div>

                <div
                    style="border-left: 2px solid black; line-height: 10px; padding-left: .5rem; font-family: Arial, Helvetica, sans-serif">
                    <h1>HEALTH RECORDS OFFICERS</h1>
                    <h1>REGISTRATION BOARD OF NIGERIA</h1>
                    <div style="line-height: 6px;">
                        <p style="font-size: small;">CAP, 165 LFN 1990 (Established by Decree 39, 1989)</p>
                        <p style="font-weight: bolder;">NATIONAL SECRETARIAT</p>
                        <p style="font-size: small;">10 Kukawa Street off Gimbiya Street, Area 11, Garid - Abuja</p>
                        <p style="font-weight: bolder;">ZONAL OFFICES:</p>
                        <p style="font-size: small;">Medical Compound, 9, Harvey Road, Yaba - Lagos</p>
                        <p style="font-size: small;">Yusuf Dantsoho Memorial Hospital, Polytechnic Road, Tudun Wada -
                            Kaduna</p>
                        <p style="font-size: small;">@20 Salma Plaza along Ganaja/Ajaokuta Road - Lokoja</p>
                        <p style="font-size: small;">Old UNTH, opposite Central Police Station - Enugu.</p>
                        <p style="font-size: small;">Federal Secretariat Annax, Room 320-322, Murtala Muhammed High Way,
                            Calabar</p>
                        <p style="font-size: small;"><span style="font-weight: bold;">Phone:</span> 0902 980 6732, 0902
                            980 6733</p>
                        <p style="font-size: small;"><span style="font-weight: bold;">e-mail:</span>
                            hrorbnabuja@gmail.com, hrorbnyaba@gmail.com, hrorbnyaba@yahoo.com</p>
                        <p style="font-size: small;"><span style="font-weight: bold;">website:</span> www.hrorbn.org.ng
                        </p>
                    </div>
                </div>

                {{-- <div style="align-self: flex-start; margin-left: 3rem;">
                <h2 style="font-family: Arial, Helvetica, sans-serif; color: red; font-weight:900">CASH RECEIPT</h2>
                <p style="font-weight: bold;">RECEIPT NO: </p>
                <span style="font-size: 28px; font-family:'Times New Roman', Times, serif; float: right; margin-top: -20px; margin-bottom: 1rem;">{{ $ExpenditureRegister->idexpenditure_payregister  }}</span>
                <p style="font-family: Arial, Helvetica, sans-serif; font-size: small; font-weight: bold; ">DATE:
                    <strong style="font-size: 23px">{{ date("Y-m-d", strtotime($ExpenditureRegister->created_at))  }}</strong> </p>
              </div> --}}
            </header>

            <div>
                <p style="font-weight: bolder;">Deptal No: <strong
                        style="font-size: 18px">{{ $ExpenditureRegister->payment_ref }}</strong> Checked and passed for
                    payment at......................................................</p>
            </div>

            <section style="display: flex;">
                <div
                    style="border: 2px solid black; padding: 1rem 0 1rem 1rem;  width: 25%; transform: rotateZ(270deg);">
                    <p>For cash in payment for Advance</p>
                    <p>Certified the Advance Of</p>
                    <p>&#8358; ........................................................</p>
                    <p>has been </p>
                    <p>Deptal No.........................................................</p>
                    <p>Signature.........................................................</p>
                    <p>Name in Blocks Letters.........................................................</p>
                </div>

                <div style="margin: 0 5px;">
                    <table style="border-collapse: collapse;" width="50%">
                        <tr>
                            <th style="border: 1px solid gray;">Data/Type3</th>
                            <th style="border: 1px solid gray;">4 Source 6</th>
                            <th style="border: 1px solid gray;">7</th>
                            <th style="border: 1px solid gray;">Voucher Number</th>
                            <th style="border: 1px solid gray;">14</th>
                        </tr>

                        <tr>
                            <td style="background-color: gray; padding: 0;">VO 1</td>
                            <td style="background-color: gray; padding: 0;">
                                <ul style="display: flex; list-style: none; margin: 0;">
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </ul>
                            </td>

                            <td style="background-color: gray; padding: 0;">
                                <ul style="display: flex; list-style: none; margin: 0;">
                                    <li>R</li>
                                    <li>E</li>
                                </ul>
                            </td>

                            <td style="background-color: gray; padding: 0; border: 1px solid gray;">
                                <ul style="display: flex; list-style: none; margin: 0;">
                                    <li
                                        style="border-right: 1px solid black; border-left: 1px solid black; padding-left: 1rem ; padding-right: 1rem; text-align: center;">
                                        X</li>
                                    <li
                                        style="border-right: 1px solid black; border-left: 1px solid black; padding-left: 1rem ; padding-right: 1rem; text-align: center;">
                                        I</li>
                                    <li
                                        style="border-right: 1px solid black; border-left: 1px solid black; padding-left: 1rem ; padding-right: 1rem; text-align: center;">
                                        9</li>
                                    <li
                                        style="border-right: 1px solid black; border-left: 1px solid black; padding-left: 1rem ; padding-right: 1rem; text-align: center;">
                                        6</li>
                                    <li
                                        style="border-right: 1px solid black; border-left: 1px solid black; padding-left: 1rem ; padding-right: 1rem; text-align: center;">
                                        3</li>
                                </ul>
                            </td>

                            <td style="background-color: gray; padding: 0;"></td>

                        </tr>

                        <tr style="border: 1px solid gray; height: 50px;">
                            <td>15</td>
                            <td>Classification Code</td>
                            <td></td>
                            <td></td>
                            <td>26</td>
                        </tr>

                        <tr style="border: 1px solid gray; padding: 0;">
                            <td>
                                <ul style="display: flex; list-style: none; margin: 0;">
                                    <li
                                        style="border-right: 1px solid black; border-left: 1px solid black; padding-left: 1rem ; padding-right: 1rem; text-align: center; height: 20px;">
                                        2</li>
                                    <li
                                        style="border-right: 1px solid black; padding-left: 1rem ; padding-right: 1rem; text-align: center; height: 20px;">
                                        5</li>
                                    <li
                                        style="border-right: 1px solid black;  padding-left: 1rem ; padding-right: 1rem; text-align: center; height: 20px;">
                                        2</li>
                                </ul>
                            </td>

                            <td>
                                <ul style="display: flex; list-style: none; margin: 0;">
                                    <li
                                        style="border-right: 1px solid black; border-left: 1px solid black; padding-left: 1rem ; padding-right: 1rem; text-align: center; height: 20px;">
                                        1</li>
                                    <li
                                        style="border-right: 1px solid black; padding-left: 1rem ; padding-right: 1rem; text-align: center; height: 20px;">
                                        0</li>
                                    <li
                                        style="border-right: 1px solid black; padding-left: 1rem ; padding-right: 1rem; text-align: center; height: 20px;">
                                        0</li>
                                </ul>
                            </td>

                            <td>
                                <ul style="display: flex; list-style: none; margin: 0;">
                                    <li
                                        style="border-right: 1px solid black; border-left: 1px solid black; padding-left: 1rem ; padding-right: 1rem; text-align: center; height: 20px;">
                                        8</li>
                                    <li
                                        style="border-right: 1px solid black; padding-left: 1rem ; padding-right: 1rem; text-align: center; height: 20px;">
                                        0</li>
                                </ul>
                            </td>

                            <td>
                                <ul style="display: flex; list-style: none; margin: 0;">
                                    <li
                                        style="border-right: 1px solid black; border-left: 1px solid black; padding-left: 1rem ; padding-right: 1rem; text-align: center; height: 20px;">
                                        0</li>
                                    <li
                                        style="border-right: 1px solid black; padding-left: 1rem ; padding-right: 1rem; text-align: center; height: 20px;">
                                        1</li>
                                    <li
                                        style="border-right: 1px solid black; padding-left: 1rem ; padding-right: 1rem; text-align: center; height: 20px;">
                                    </li>
                                </ul>
                            </td>

                        </tr>

                        <tr style="border: 1px solid gray; padding: 0;">
                            <td>27</td>
                            <td>
                                <ul style="display: flex; list-style: none; margin: 0;">
                                    <li
                                        style="border-right: 1px solid black; border-left: 1px solid black; padding-left: 1rem ; padding-right: 1rem; text-align: center; height: 20px;">
                                        Date</li>
                                    <li
                                        style="border-right: 1px solid black; padding-left: 1rem ; padding-right: 1rem; text-align: center; height: 20px;">
                                        32</li>
                                </ul>
                            </td>

                            <td>32</td>

                            <td>
                                <ul style="display: flex; list-style: none; margin: 0;">
                                    <li
                                        style=" padding-left: 1rem ; padding-right: 1rem; text-align: center; height: 20px;">
                                    </li>
                                    <li
                                        style="padding-left: 1rem ; padding-right: 1rem; text-align: center; height: 20px;">
                                    </li>
                                    <li
                                        style="padding-left: 1rem ; padding-right: 1rem; text-align: center; height: 20px;">
                                        Amount</li>
                                </ul>
                            </td>
                        </tr>

                        <tr style="border: 1px solid gray; padding: 0;">
                            <td>

                            </td>

                            <td colspan="2">
                                <ul style="display: flex; list-style: none; margin: 0;">

                                    <li
                                        style="border-right: 1px solid black; padding-left: 1rem ; padding-right: 1rem; text-align: center; height: 20px;">
                                        {{ date('Y-m-d', strtotime($ExpenditureRegister->created_at)) }}
                                    </li>
                                </ul>
                            </td>



                            <td>
                                <ul style="display: flex; list-style: none; margin: 0;">
                                    <li
                                        style="border-right: 1px solid black; padding-left: 1rem ; padding-right: 1rem; text-align: center; height: 20px;">
                                        &#8358;{{ number_format($ExpenditureRegister->amount, 2) }}</li>
                                    <!-- <li style="border-right: 1px solid black; padding-left: 1rem ; padding-right: 1rem; text-align: center; height: 20px;"></li> -->
                                </ul>
                            </td>

                        </tr>

                        <tr style="border: 1px solid gray; padding: 0; height: 50px;">
                            <td>Source &nbsp; &nbsp; &nbsp; 49</td>
                            <td>Classification Code</td>
                            <td></td>
                            <td>60</td>
                            <td></td>
                        </tr>

                        <tr style="border: 1px solid gray; padding: 0;">
                            <td>

                            </td>

                            <td>

                            </td>

                            <td>

                            </td>

                            <td>
                                <ul style="display: flex; list-style: none; margin: 0;">
                                    <li
                                        style="border-right: 1px solid black; padding-left: 1rem ; padding-right: 1rem; text-align: center; height: 20px;">
                                        {{ $ExpenditureRegister->expenditure_code }}</li>
                                    <!-- <li style="border-right: 1px solid black; padding-left: 1rem ; padding-right: 1rem; text-align: center; height: 20px;"></li> -->
                                </ul>
                            </td>

                        </tr>
                    </table>
                </div>

                <div style="border: 1px solid gray; flex: 1; height: 20%;">
                    <p style="padding: 0; margin: 0; border-bottom: 1px solid gray;">Station</p>
                    <p style="padding: 0; margin: 0; border-bottom: 1px solid gray;"><span
                            style="border-right: 1px solid gray; padding-right: 1rem;">Head</span></p>
                    <p style="padding: 0; margin: 0;"><span
                            style="border-right: 1px solid gray; padding-right: 1rem;">S/Head</span></p>
                    {{ $ExpenditureRegister->expenditure_code }}
                </div>
            </section>

            <section style="font-family: Arial, Helvetica, sans-serif; margin: 1rem 0;">
                <p>Payee <strong>{{ $ExpenditureRegister->name }}</strong></p>
                <p>Address....................................................................................................................................................................................................................................
                </p>
            </section>

            <section style="font-family: Arial, Helvetica, sans-serif; margin-bottom: 1rem;">
                <table style=" border-collapse: collapse; width: 100%;">
                    <tr>
                        <th style="border: 1px solid gray;"></th>
                        <th style="border: 1px solid gray;">Detailed Description of Service/Work</th>
                        <th style="border: 1px solid gray;">Rate</th>
                        <th style="border: 1px solid gray;">&#8358;</th>
                        <th style="border: 1px solid gray;">K</th>
                    </tr>

                    <tr style="border: 1px solid gray;">
                        <td
                            style="height: 200px; width: 5px; border-right: 1px solid gray; border-bottom: 1px solid gray;">
                        </td>
                        <td
                            style="height: 200px; width: 80px; border-right: 1px solid gray; border-bottom: 1px solid gray;">
                            {{ $ExpenditureRegister->narration }}
                        </td>
                        <td
                            style="height: 200px; width: 1px; border-right: 1px solid gray; border-bottom: 1px solid gray;">
                        </td>
                        <td
                            style="height: 200px; width: 4px; border-right: 1px solid gray; border-bottom: 1px solid gray; padding-left: 10px">
                            {{ number_format($ExpenditureRegister->amount, 2) }}
                        </td>
                        <td
                            style="height: 200px; width: 4px; border-right: 1px solid gray; border-bottom: 1px solid gray;">
                        </td>
                    </tr>

                    <tr style="border: 1px solid gray;">
                        <td
                            style="height: 40px; width: 5px; border-right: 1px solid gray; border-bottom: 1px solid gray;">
                        </td>
                        <td
                            style="height: 40px; width: 80px; border-right: 1px solid gray; border-bottom: 1px solid gray; padding: 4px">

                            {{-- Checked and Passed for --}}
                            Insert Amount in words <br>
                            <strong><span id="word"></span> Naira Only</strong>

                        </td>
                        <td
                            style="height: 40px; width: 1px; border-right: 1px solid gray; border-bottom: 1px solid gray; text-align: right;">
                            Total &#8358;</td>
                        <td
                            style="height: 40px; width: 4px; border-right: 1px solid gray; border-bottom: 1px solid gray; padding-left: 10px">
                            {{ number_format($ExpenditureRegister->amount, 2) }}</td>
                        <td
                            style="height: 40px; width: 4px; border-right: 1px solid gray; border-bottom: 1px solid gray;">
                        </td>
                    </tr>
                </table>
            </section>

            <section
                style="font-family: Arial, Helvetica, sans-serif; margin-bottom: 1rem; display: flex; justify-content: space-around;">
                <div style="border: 1px solid gray; padding: .8rem .5rem; ">
                    <p>Payable at <strong>Abuja</strong></p>
                    <p>Signature.................................................</p>
                    <p>Name in blocks letters.................................................</p>
                    <p>Location.................................... Date
                        <strong>{{ date('Y-m-d', strtotime($ExpenditureRegister->created_at)) }}</strong></p>
                    <p>Serving Officer..........................................</p>
                    <p>Signature..........................................</p>
                    <p>Name in blocks letters..........................................</p>
                </div>

                <div style="width: 45%;">
                    <p>I certify that the above amount is correct, and was incurred under the Authority Quoted: that the
                        service has been dully performed: that the rate/price charged is according to
                        regulations/contract is fair and reasonable
                    </p>

                    <p>That the amount of <strong><span id="word1"></span></strong> Kobo may be paid under the
                        Classification quoted.</p>

                    <div style="text-align: center;">
                        <p style="padding: 0; margin: 0;">.....................................</p>
                        <p style="padding: 0; margin: 0;">Officer Cont. Signature</p>
                    </div>

                    <p>Place........................... Date
                        <strong>{{ date('Y-m-d', strtotime($ExpenditureRegister->created_at)) }}</strong> </p>

                    <p style="text-align: right;">Delegatives..........................................</p>
                </div>
            </section>

            <div style="font-family: Arial, Helvetica, sans-serif;">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam,
                    laboriosam.............................................................. Lorem ipsum dolor sit.</p>

                <div style="text-align: right;">
                    <p style="padding: 0; margin: 0;">..........................</p>
                    <p style="padding: 0; margin: 0;">Signature</p>
                </div>
            </div>
        </main>
    </div>



    <script>
        // System for American Numbering
        var th_val = ['', 'thousand', 'million', 'billion', 'trillion'];
        // System for uncomment this line for Number of English
        // var th_val = ['','thousand','million', 'milliard','billion'];

        var dg_val = ['Zero', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];
        var tn_val = ['Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen',
            'Nineteen'
        ];
        var tw_val = ['Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

        function toWordsconver(s) {
            s = s.toString();
            s = s.replace(/[\, ]/g, '');
            if (s != parseFloat(s))
                return 'not a number ';
            var x_val = s.indexOf('.');
            if (x_val == -1)
                x_val = s.length;
            if (x_val > 15)
                return 'too big';
            var n_val = s.split('');
            var str_val = '';
            var sk_val = 0;
            for (var i = 0; i < x_val; i++) {
                if ((x_val - i) % 3 == 2) {
                    if (n_val[i] == '1') {
                        str_val += tn_val[Number(n_val[i + 1])] + ' ';
                        i++;
                        sk_val = 1;
                    } else if (n_val[i] != 0) {
                        str_val += tw_val[n_val[i] - 2] + ' ';
                        sk_val = 1;
                    }
                } else if (n_val[i] != 0) {
                    str_val += dg_val[n_val[i]] + ' ';
                    if ((x_val - i) % 3 == 0)
                        str_val += 'hundred ';
                    sk_val = 1;
                }
                if ((x_val - i) % 3 == 1) {
                    if (sk_val)
                        str_val += th_val[(x_val - i - 1) / 3] + ' ';
                    sk_val = 0;
                }
            }
            if (x_val != s.length) {
                var y_val = s.length;
                str_val += 'point ';
                for (var i = x_val + 1; i < y_val; i++)
                    str_val += dg_val[n_val[i]] + ' ';
            }
            return str_val.replace(/\s+/g, ' ');
        }
        var number = {{ @$ExpenditureRegister->amount }};
        var Inwords = toWordsconver(number);
        document.getElementById("word").innerHTML += Inwords;
        document.getElementById("word1").innerHTML += Inwords;




        function printDiv(invoice) {
            var printContents = document.getElementById("invoice").innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
</body>

</html>
