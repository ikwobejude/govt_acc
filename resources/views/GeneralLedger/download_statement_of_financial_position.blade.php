
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
                HEALTH RECORDS OFFICERS REGISTRATION BOARD OF NIGERIA <br>
                STATEMENT OF FINACIAL POSITION AS FROM {{ strtoupper($from) ." - ".strtoupper($to) }}. <br>
            </h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-stripe">
                        <thead>

                            <tr>
                                <th><strong>ASSET</strong></th>
                                <th><strong>NCOA CODES</strong></th>
                                <th><strong>Notes</strong></th>
                                <th><strong>2024</strong></th>
                            </tr>

                        </thead>

                        <tbody>
                         <?php
                            $totalEquity1 = 0;
                            $liabilitySum = 0;
                            $count = 0;
                            $sumTotalAsset = 0;
                            $sumTotalLiability = 0;
                            $alpha = ['A', 'B'];
                          ?>

                          @foreach ($asset->groupBy('assest_type') as $assest_type => $rev)
                          <?php
                                $assetsum = 0;
                            ?>
                          <tr>
                              <td><strong>{{ strtoupper($assest_type) }}</strong></td>
                              <td></td>
                              <td></td>
                              <td></td>
                          </tr>

                            @foreach ($rev as $key => $item)
                            <?php
                            $count++;
                            $assetsum += (float)$item->opening_value;
                            ?>
                            <tr>
                                {{-- <td>{{ $key + 1}}</td> --}}
                                <td>{{ strtoupper($item->assest_name) }} </td>
                                <td>{{ $item->asset_rev }} </td>
                                <td></td>
                                <td>{{ number_format($item->opening_value, 2) }}</td>
                            </tr>
                            @endforeach
                            <?php $sumTotalAsset += $assetsum; ?>
                            <tr>
                                <td colspan="3" style="text-align: right"> <strong>{{ "TOTAL ".strtoupper($assest_type)."= ".$alpha[$key] }}</strong> </td>

                                <td>{{ number_format($assetsum, 2) }}</td>
                            </tr>
                          @endforeach
                          <tr>
                            <td colspan="3" style="text-align: right"> <strong>TOTAL ASSETS C=A+B</strong> </td>

                            <td>{{ number_format($sumTotalAsset, 2) }}</td>
                        </tr>
                          {{-- Total Current Assets = A
                          Total Non-Current Assets = B
                          Total Assets    C  =   A + B --}}

                          <tr>
                             <td><strong><u>LIABILITIES</u> </strong></td>
                             <td><strong></strong></td>
                             <td><strong></strong></td>
                             <td><strong></strong></td>
                          </tr>
                          <?php $alpha1 = ['D', 'E']; ?>
                          @foreach ($liability->groupBy('type_of_liability') as $type_of_liability => $rev)

                          <tr>
                              <td><strong>{{ strtoupper( $type_of_liability) }}</strong></td>
                              <td></td>
                              <td></td>
                              <td></td>
                          </tr>

                            @foreach ($rev as $key => $item)
                            <?php
                                $count++;
                                $liabilitySum += (float)$item->amount;
                            ?>
                            <tr>
                                <td> {{ strtoupper($item->liability) }} </td>
                                <td> {{ $item->economic_code }} </td>
                                <td>{{ $count }}</td>
                                <td>{{ number_format($item->amount, 2) }}</td>
                            </tr>
                            @endforeach
                            <?php $sumTotalLiability += $liabilitySum; ?>
                            <tr>
                                <td colspan="3" style="text-align: right"> <strong> {{ "TOTAL ".strtoupper($type_of_liability)." LIABILITY = ".$alpha1[$key] }} </strong></td>
                                <td>{{ number_format($liabilitySum, 2) }}</td>
                            </tr>
                          @endforeach
                          <tr>
                            <td colspan="3" style="text-align: right"> <strong>TOTAL LIABILITIES F = D + E </strong></td>
                            <td>{{ number_format($sumTotalLiability, 2) }}</td>
                          </tr>
                          <tr>
                            <td colspan="3" style="text-align: right"> <strong>NET ASSETS G  = C - F </strong></td>
                            <td>{{ number_format($sumTotalAsset - $sumTotalLiability, 2) }}</td>
                          </tr>

                          {{-- Total Current Liabilities = D
                          Total Non-Current Liabilities = E
                          Total Liabilities: F = D + E
                          Net Assets:  G  = C - F --}}

                          {{-- NET ASSETS/EQUITY --}}

                          <tr>
                            <td><strong><u>NET ASSETS/EQUITY</u></strong></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>



                        @foreach ($revenue as $key => $item)
                        <?php
                            $count++;
                            $totalEquity1 += (float)$item->revenue_amount;
                        ?>
                        <tr>
                            <td> {{ $item->received_from }} </td>
                            <td> </td>
                            <td>{{ $count }}</td>
                            <td>{{ number_format($item->revenue_amount, 2) }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" style="text-align: right"><strong>TOTAL EQUITY</strong></td>
                            {{-- <td></td> --}}
                            <td>{{ number_format($totalEquity1, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3"style="text-align: right"><strong> TOTAL EQUITY AND LIABILITY </strong></td>
                            {{-- <td></td> --}}
                            <td>{{ number_format($totalEquity1 + $liabilitySum, 2) }}</td>
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
