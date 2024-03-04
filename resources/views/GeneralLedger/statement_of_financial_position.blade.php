@extends('admin_dashboard')
<style>
    .td {
        border: 1px solid black;
        border-top: 1px solid black
    }
</style>
@section('admin')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span>Statement of Financial Position</h4>

        <div class="row">



            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header" style="text-align: center">
                        HEALTH RECORDS OFFICERS REGISTRATION BOARD OF NIGERIA <br>
                        STATEMENT OF FINACIAL POSITION AS 31ST DEC 2024. <br>
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
                                  <?php
                                        $liabilitySum = 0;
                                    ?>
                                  <tr>
                                      <td><strong>{{ strtoupper( $type_of_liability) }}</strong></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                  </tr>
                                  <?php
                                        $totalEquity = 0;
                                    ?>
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
                                    $totalEquity += (float)$item->revenue_amount;
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
                                    <td>{{ number_format($totalEquity, 2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3"style="text-align: right"><strong> TOTAL EQUITY AND LIABILITY </strong></td>
                                    {{-- <td></td> --}}
                                    <td>{{ number_format($totalEquity + $liabilitySum, 2) }}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>






        </div>
    </div>



@endsection
