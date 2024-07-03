
<?php

// dd($pensions);
$ExportFileName = $from."-".$to." cash_flow.xls";
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
                FEDERAL MINISTRY Of HEALTH: HEALTH RECORDS OFFICER'S REGISTRATION BOARD OF NIGERIA <br>
                FERDERAL GOVERNMENT OF NIGERIA <br>
                STATEMENT OF CASH FLOW FOR {{ strtoupper($from) ." - ".strtoupper($to) }}
            </h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-stripe">
                        <thead>
                            <tr>
                                <th rowspan="2"><strong>Description</strong></th>
                                <th></th>
                                <th rowspan="2"><strong>NCOA CODES</strong></th>
                                <th><strong>Notes</strong></th>
                                <th colspan="2"><strong>2024</strong></th>
                                {{-- <th><strong>2024</strong></th> --}}
                            </tr>
                            <tr>
                                {{-- <th><strong>Description</strong></th> --}}
                                <th></th>
                                {{-- <th><strong>NCOA CODES</strong></th> --}}
                                <th><strong>Notes</strong></th>
                                <th><strong>N</strong></th>
                                <th><strong>N</strong></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th>COA REF.</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>

                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5">
                                    <strong>CASH FLOWS FROM OPERATING ACTIVITIES</strong>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <strong>Inflows</strong>
                                </td>
                            </tr>
                            <?php
                                $totalInflow = 0;
                                $totalOutflow = 0;
                                $totalCashflowFromInv = 0;
                                $totalCashflowFromAct = 0;
                                $netCashInOutFlow =0;
                                $all_activity_net_cash_flow =0;
                            ?>
                            @foreach ($revenue as $item)
                            <?php $totalInflow += $item->total; ?>
                            <tr>
                                <td>{{ $item->line }}</td>
                                <td></td>
                                <td>{{ $item->code }}</td>
                                <td></td>
                                <td>{{ number_format($item->total, 2) }}</td>
                                <td></td>
                            </tr>
                            @endforeach

                            {{-- TODO: TOTAL --}}
                            <tr>
                                <td colspan="4" style="text-align: right">
                                    <strong>Total Inflow from Operating Activities  (A) </strong>
                                </td>
                                <td>{{ number_format($totalInflow, 2) }}</td>
                                <td>{{ number_format($totalInflow, 2) }}</td>
                            </tr>


                            <tr>
                                <td colspan="6">
                                    <strong>Outflows</strong>
                                </td>
                            </tr>

                            @foreach ($ExpenditureRegister as $item)
                            <?php $totalOutflow += $item->total; ?>
                            <tr>
                                <td>{{ $item->line }}</td>
                                <td></td>
                                <td>{{ $item->code }}</td>
                                <td></td>
                                <td>{{ number_format($item->total, 2) }}</td>
                                <td></td>
                            </tr>
                            @endforeach

                            <tr>
                                <td colspan="4" style="text-align: right">
                                    <strong>Total Outflow from Operating Activities (B)</strong>
                                </td>
                                <td>{{ number_format($totalOutflow, 2) }}</td>
                                <td>{{ number_format($totalOutflow, 2) }}</td>
                            </tr>

                            <tr>
                                <td colspan="4" style="text-align: right">
                                    <strong>Net Cash Inflow/(Outflow) From Operating Activities* C=(A-B)</strong>
                                </td>
                                <td></td>
                                <td>
                                    <?php $netCashInOutFlow = $totalInflow - $totalOutflow; ?>
                                    {{ number_format($netCashInOutFlow, 2) }}
                                </td>
                            </tr>


                            <tr>
                                <td colspan="6">
                                    <strong>CASH FLOW FROM INVESTING ACTIVITIES</strong>
                                </td>
                            </tr>
                            @foreach ($asset as $item)
                            <?php $totalCashflowFromInv += $item->total; ?>
                            <tr>
                                <td>{{ $item->line }}</td>
                                <td></td>
                                <td>{{ $item->code }}</td>
                                <td></td>
                                <td>{{ number_format($item->total, 2) }}</td>
                                <td></td>
                            </tr>
                            @endforeach

                            <tr>
                                <td colspan="4" style="text-align: right">
                                    <strong>Net Cash Flow from Investing Activites</strong>
                                </td>
                                <td>{{ number_format($totalCashflowFromInv, 2) }}</td>
                                <td>{{ number_format($totalCashflowFromInv, 2) }}</td>
                            </tr>


                            <tr>
                                <td colspan="6">
                                    <strong>CASH FLOW FROM FINANCING ACTIVITIES</strong>
                                </td>
                            </tr>

                            @foreach ($liability as $item)
                            <?php $totalCashflowFromAct += $item->total; ?>
                            <tr>
                                <td>{{ $item->line }}</td>
                                <td></td>
                                <td>{{ $item->code }}</td>
                                <td></td>
                                <td>{{ number_format($item->total, 2) }}</td>
                                <td></td>
                            </tr>
                            @endforeach

                            <tr>
                                <td colspan="4" style="text-align: right">
                                    <strong>Net Cash Flow from Financing Activities</strong>
                                </td>
                                <td></td>
                                <td>{{ number_format($totalCashflowFromAct, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: right">
                                    <strong>Net Cash Flow from all Activities</strong>
                                </td>
                                <td></td>
                                <?php $all_activity_net_cash_flow = $netCashInOutFlow - $totalCashflowFromInv - $totalCashflowFromAct; ?>
                                <td>{{ $all_activity_net_cash_flow < 0 ? "(".number_format(abs($all_activity_net_cash_flow), 2). ")" : number_format($all_activity_net_cash_flow, 2) }}</td>
                            </tr>

                            <tr>
                                <td colspan="6">
                                    <strong>RECONCILIATION:</strong>
                                </td>
                            </tr>
                            <tr>
                                <td  colspan="4" style="text-align: right"><strong>Surplus/ (Deficit) per Statement of Performance</strong></td>
                                <td></td>
                                <td>{{ $netCashInOutFlow < 0 ? "(". number_format(abs($netCashInOutFlow), 2) .")" : number_format($netCashInOutFlow, 2) }}</td>
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
