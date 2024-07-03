
<?php

// dd($pensions);
$ExportFileName = $from."-".$to." financial_performance.xls";
// dd($ExportFileName);

//Set Content type to Excel
header('Content-Type: application/vnd.ms-excel');
//Fix IE 5.0-5.5 bug with Content-Disposition=attachment
if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 5.5;') || strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 5.0;')) {
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: filename=' . $ExportFileName);
} else {
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename=' . $ExportFileName);
}
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
        <div class="card mb-4">
            <h5 class="card-header" style="text-align: center">
                HEALTH RECORDS OFFICER'S  REGISTRATION BOARD OF NIGERIA <br>
                FEDERAL  GOVERNMENT OF NIGERIA <br>
                STATEMENT OF FINANCIAL PERFORMANCE  FROM {{ strtoupper($from) ." - ".strtoupper($to) }}
            </h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-stripe">
                        <thead>
                            <tr>
                                <th><strong>Previous Year Actual (2020)</strong></th>
                                <th></th>
                                <th><strong>NCOA CODES</strong></th>
                                <th><strong>Notes</strong></th>
                                <th><strong>Actual 2024</strong></th>
                                {{-- <th><strong>2024</strong></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td colspan="4">
                                    <strong>REVENUE </strong>
                                </td>
                            </tr>

                            <?php
                                $totalRevenue = 0;
                                $totalExpenditure = 0;
                            ?>

                            @foreach ($revenue as $item)
                            <?php $totalRevenue += (float)$item->total;  ?>
                            <tr>
                                <td></td>
                                <td>{{ $item->line }}</td>
                                <td>{{ $item->code }}</td>
                                <td></td>
                                <td>{{ number_format($item->total, 2) }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td colspan="3" style="text-align: right"><strong>Total Revenue (a)</strong></td>
                                {{-- <td></td>
                                <td></td> --}}
                                <td>{{ number_format($totalRevenue, 2) }}</td>
                            </tr>

                            {{-- TODO: TOTAL --}}


                            <tr>
                                <td></td>
                                <td colspan="4">
                                    <strong>EXPENDITURE </strong>
                                </td>
                            </tr>

                            @foreach ($ExpenditureRegister as $item)
                            <?php $totalExpenditure += (float)$item->total; ?>
                            <tr>
                                <td></td>
                                <td>{{ $item->line }}</td>
                                <td>{{ $item->code }}</td>
                                <td></td>
                                <td>{{ number_format($item->total, 2) }}</td>
                            </tr>
                            @endforeach

                            <tr>
                                <td></td>
                                <td colspan="3" style="text-align: right"><strong>Total Expenditure (b)</strong></td>
                                {{-- <td></td>
                                <td></td> --}}
                                <td>{{ number_format($totalExpenditure, 2) }}</td>
                            </tr>
                            <?php
                                $dta = $totalRevenue - $totalExpenditure;
                                $dta1 = $totalRevenue + $totalExpenditure;
                            ?>

                            <tr>
                                <td colspan="5"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="3" style="text-align: right">
                                    <strong>Surplus/(Deficit) from Ordinary Activities e=(c+d)</strong>
                                </td>
                                {{-- <td></td>
                                <td></td> --}}
                                <td>{{ number_format($dta, 2) }}</td>
                            </tr>

                            <tr><td colspan="5"></td></tr>
                            <tr>
                                <td></td>
                                <td colspan="3" style="text-align: right"><strong>Surplus/(Deficit) from Operating Activities for the Period c=(a-b)</strong></td>
                                {{-- <td></td>
                                <td></td> --}}
                                <td>{{ number_format($dta1, 2) }}</td>
                            </tr>
                            <tr><td colspan="5"></td></tr>
                            <tr>
                                <td></td>
                                <td><strong>Minority Interest Share of Surplus/ (Deficit) (f)</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="5"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="3" style="text-align: right"><strong>Net Surplus/ (Deficit) for the Period g=(e-f)</strong></td>
                                {{-- <td></td>
                                <td></td> --}}
                                <td>{{ number_format($dta1, 2) }}</td>
                            </tr>


                        </tbody>

                    </table>
                </div>

            </div>
        </div>

      </div>



    <!-- <div id="notices">
    <div>NOTICE:</div>
    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
  </div> -->
    </main>

    </tab>
