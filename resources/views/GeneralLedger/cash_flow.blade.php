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
                        FEDERAL MINISTRY Of HEALTH: HEALTH RECORDS OFFICER'S REGISTRATION BOARD OF NIGERIA <br>
                        FERDERAL GOVERNMENT OF NIGERIA <br>
                        STATEMENT OF CASH FLOW FOR THE YEAR ENDED 31ST DECEMBER, 2021
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
