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
                <div class="accordion mb-4" id="accordionExample">
                    <div class="card accordion-item">
                      <h2 class="accordion-header" id="headingOne">
                        <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                          Search
                        </button>
                      </h2>

                      <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="card-body">
                                <form action="{{ route('financial_position') }}" method="get">
                                    @csrf
                                    <div class="fieldset">
                                        <h1>Search</h1>
                                        <div class="row">

                                            <div class="col-md-6 col-sm-6">
                                                <div class="form-floating mb-3">
                                                    <input type="date" name="from" id="from" class="form-control" >
                                                    <label for="floatingInput">From</label>
                                                    <div id="floatingInputHelp" class="form-text"></div>
                                                    @error('batch_type')
                                                        <span class="text-danger"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <div class="form-floating mb-3">
                                                    <input type="date" name="to" id="to" class="form-control" >
                                                    <label for="floatingInput">TO</label>
                                                    <div id="floatingInputHelp" class="form-text"></div>
                                                    @error('batch_type')
                                                        <span class="text-danger"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col"></div>
                                            <div class="col" style="text-align: right">
                                                <button type="submit" class="btn btn-primary me-2">Search</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>

                              </div>
                        </div>
                      </div>
                    </div>
                </div>

            </div>


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






        </div>
    </div>



@endsection
