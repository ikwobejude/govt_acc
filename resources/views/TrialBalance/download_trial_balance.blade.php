
<?php

// dd($pensions);
$ExportFileName = $today->toFormattedDateString()."trial_balance.xls";


//Set Content type to Excel
// header('Content-Type: application/vnd.ms-excel');
//Fix IE 5.0-5.5 bug with Content-Disposition=attachment
// if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 5.5;') || strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 5.0;')) {
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: filename=' . $ExportFileName);
// } else {
//     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//     header('Content-Disposition: attachment; filename=' . $ExportFileName);
// }

dd($ExportFileName);
?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="GENERATOR" content="CodeCharge Studio 5.0.0.16254" />
    <meta http-equiv="content-type" content="application/xhtml+xml; charset=windows-1252" />

    <title>Pension Report</title>
</head>

<body>
    {{-- <p style="text-align: center;">SmartPay - Monthly Payroll For COLLEGE OF HEALTH TECHNOLOGY PANKSHIN PENSION COLLEGE OF HEALTH TECHNOLOGY PANKSHIN PENSION in {{ $month }}, 2023</p> --}}

    <div class="card-body">
        <h5 class="card-header" style="text-align: center">
            FEDERAL GOVERNMENT OF NIGERIA <br>
            HEALTH RECORDS OFFICERS REGISTRATION BOARD OF NIGERIA <br>
            MONTHLY IPSAS ACCRUAL BASIS COMPLIANT TRIAL BALANCE FROM {{ "JAN 1, ".date('Y')." - ". strtoupper($today->toFormattedDateString()) }}. <br>
        </h5>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-stripe table-bordered">
                    <thead>

                        <tr>
                            <th colspan="2">ADMINISTRATATIVE CODE</th>
                            <th colspan="10">052100800100</th>
                        </tr>
                        <tr>
                            <th ></th>
                            <th></th>
                            <th rowspan="2">DR₦</th>
                            <th rowspan="2">CR₦</th>
                            <th colspan="8">ANALYSIS OF ECONOMIC ITEMS ACCORDING TO SOURCES OF FUNDS</th>
                        </tr>
                        <tr>
                            <th>ECONOMIC CODE</th>
                            <th>DESCRIPTION</th>
                            {{-- <th></th>
                            <th> </th> --}}
                            <th>BUDGET </th>
                            <th>SERVICE WIDE VOTES </th>
                            <th>CAPITAL SUPPPLEMENTATION </th>
                            <th>AID & GRANTS </th>
                            <th>RETAINED IGR </th>
                            <th>LOANS </th>
                            <th>OTHER FUNDS </th>
                            <th>OTHERS-SPECIFY </th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>02101 </th>
                            <th>SERVICE WIDE VOTES </th>
                            <th>02203</th>
                            <th>08</th>
                            <th>10</th>
                            <th>09</th>
                            <th>06</th>
                            <th>xx</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            $sumTotalDB = 0;
                            $sumTotalCD = 0;
                        ?>

                            @foreach ($arr as $item)
                            <?php
                                $sumTotalDB += (float)$item['totaldb'];
                                $sumTotalCD += (float)$item['totalcr'];
                            ?>
                                <tr>
                                    <td>{{ $item['economic_code'] }}</td>
                                    <td>{{ $item['revenue_line'] }}</td>
                                    <td>{{  number_format($item['totaldb'], 2) }}</td>
                                    <td>{{  number_format($item['totalcr'], 2) }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        @if ($item['totaldb'] > 0)
                                        {{ number_format($item['totaldb'], 2) }}
                                        @else
                                        {{ number_format($item['totalcr'], 2) }}
                                        @endif

                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforeach
                        {{-- @endforeach --}}
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>{{  number_format($sumTotalDB, 2) }}</td>
                            <td>{{  number_format($sumTotalCD, 2) }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{  number_format($sumTotalDB + $sumTotalCD, 2) }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>

      </div>



    <!-- <div id="notices">
    <div>NOTICE:</div>
    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
  </div> -->
    </main>

    </tab>
