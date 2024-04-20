@extends('admin_dashboard')
<style>
    .td {
        border: 1px solid black;
        border-top: 1px solid black
    }
</style>
<?php
    // dd(strtotime($to));

    $timestamp = $currentT == 1 ? strtotime($to) : \Carbon\Carbon::now()->format('Y-m-d');;
    // $day = date('D', $timestamp);
    // $month = date('M', $timestamp);

    // $final_Date = date('d', $timestamp) .' '. date('M', $timestamp)
    // dd($timestamp);
?>

@section('admin')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span>Statement of Financial Cash Flow</h4>

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



            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header" style="text-align: center">
                        FEDERAL MINISTRY Of HEALTH: HEALTH RECORDS OFFICER'S REGISTRATION BOARD OF NIGERIA <br>
                        FERDERAL GOVERNMENT OF NIGERIA <br>
                        STATEMENT OF CASH FLOW FOR {{ strtoupper($from->toFormattedDateString()) ." - ".strtoupper($to->toFormattedDateString()) }}
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






        </div>
    </div>



@endsection
