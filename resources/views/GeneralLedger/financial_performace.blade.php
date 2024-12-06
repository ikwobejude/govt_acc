@extends('admin_dashboard')
<style>
    .td {
        border: 1px solid black;
        border-top: 1px solid black
    }
</style>
@section('admin')
<?php
//  dd($from)
?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span>Statement of Financial Performance</h4>

        <div class="row">

            <div class="col-md-8">
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
                                <form action="{{ route('financial_performance') }}" method="get">
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

            <div class="col-md-8">
                <div class="card mb-4">
                    <h5 class="card-header" style="text-align: center">
                        HEALTH RECORDS OFFICER'S  REGISTRATION BOARD OF NIGERIA <br>
                        FEDERAL  GOVERNMENT OF NIGERIA <br>
                        STATEMENT OF FINANCIAL PERFORMANCE  FROM {{ strtoupper($from) ." - ".strtoupper($to) }}
                    </h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 pb-3" style="text-align: right">
                                <a href="{{ route('download.financial_performance', ['from'=>$from, 'to'=>$to]) }}" class="btn btn-primary">Download to Excel</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-stripe">
                                <thead>
                                    <tr>
                                        {{-- <th><strong>Previous Year Actual (2020)</strong></th> --}}
                                        <th></th>
                                        {{-- <th><strong>NCOA CODES</strong></th> --}}
                                        <th style="width: 5%"><strong>Notes</strong></th>
                                        <th><strong>Actual 2024</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>REVENUE </strong></td>
                                        <td colspan="2"></td>
                                    </tr>

                                    <?php
                                        $totalRevenue = 0;
                                        $totalExpenditure = 0;
                                        $remita = 0
                                    ?>

                                    @foreach ($revenue as $item)
                                    <?php $totalRevenue += (float)$item->total;  ?>
                                    <tr>
                                        {{-- <td></td> --}}
                                        <td>{{ $item->note == 6 ? "Recurrent Subvention from Federal Government": "Internally Generated Revenue" }}</td>
                                        {{-- <td>{{ $item->code }}</td> --}}
                                        <td>{{ $item->note }}</td>
                                        <td>{{ number_format($item->total, 2) }}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td style="text-align: right"><strong></strong></td>
                                        {{-- <td></td>
                                        <td></td> --}}
                                        <td><strong>{{ number_format($totalRevenue, 2) }}</strong></td>
                                    </tr>

                                    {{-- TODO: TOTAL --}}

                                    @foreach ($Remittance as $Remitt)
                                    <?php $remita += (float)$Remitt->total;  ?>
                                    <tr>
                                        {{-- <td></td> --}}
                                        <td>{{ $Remitt->note == 24 ? "Remittance to CRF and sub-treasury": "" }}</td>
                                        {{-- <td>{{ $item->code }}</td> --}}
                                        <td></td>
                                        <td>({{ number_format($Remitt->total, 2) }})</td>
                                    </tr>
                                    @endforeach
                                    <?php $revTotal = $totalRevenue - $remita ?>
                                    <tr>
                                        <td></td>
                                        <td style="text-align: right"><strong></strong></td>
                                        {{-- <td></td>
                                        <td></td> --}}
                                        <td><strong>{{ number_format($revTotal, 2) }}</strong></td>
                                    </tr>



                                    <tr>
                                        <td colspan="2"><strong>OPERATING EXPENSES </strong></td>
                                    </tr>

                                    @foreach ($ExpenditureRegister as $item)
                                    <?php $totalExpenditure += (float)$item->total; ?>
                                    <tr>
                                        <td>{{ $item->note_group == "Personnel Cost" ? "Personnel Cost":  "Administrative Expenses" }}</td>
                                        <td>{{ $item->note_group == "Personnel Cost" ? "9":  "10" }}</td>
                                        <td>{{ number_format($item->total, 2) }}</td>
                                    </tr>
                                    @endforeach

                                    <tr>
                                        <td></td>
                                        <td style="text-align: right"></td>
                                        <td><strong>{{ number_format($totalExpenditure, 2) }}</strong></td>
                                    </tr>
                                    <?php
                                        $dta = $totalRevenue - $totalExpenditure;
                                        $dta1 = $totalRevenue + $totalExpenditure;
                                    ?>


                                    <tr>
                                        <td><strong>Surplus/(Deficit)</strong></td>
                                        <td style="text-align: right"></td>
                                        <td><strong>{{ number_format($dta - $revTotal, 2) }}</strong></td>
                                    </tr>


                                    <tr>
                                        <td><strong>Other Comprehensive Income for the Year:</strong></td>
                                        <td></td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Items that will not be reclassified to Receipt and Payments:</strong></td>
                                        <td></td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Gain on disposal of property</strong></td>
                                        <td></td>
                                        <td>-</td>
                                    </tr>

                                    <tr>
                                        <td><strong>Items that may be reclassified subsequently to Receipts and Payments</strong></td>
                                        <td style="text-align: right"></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td><strong>Gain on foreign currency translation</strong></td>
                                        <td style="text-align: right"></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td><strong>Total Other Comprehensive Income</strong></td>
                                        <td style="text-align: right"></td>
                                        <td><strong>{{ number_format($dta - $revTotal, 2) }}</strong></td>
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
