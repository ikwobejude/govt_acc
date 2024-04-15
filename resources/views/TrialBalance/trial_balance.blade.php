@extends('admin_dashboard')
<style>
    .td {
        border: 1px solid black;
        border-top: 1px solid black
    }
</style>
@section('admin')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span>TRIAL BALANCE</h4>

        <div class="row">



            <div class="col-md-12">
                <div class="card mb-4">
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
                                    {{-- @foreach ( $arr->groupBy(arr['economic_type']) as $economic_code => $rev) --}}
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
            </div>






        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Revenue Line</label>
                            <input type="text" id="nameWithTitle" class="form-control" placeholder="Enter Name" />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="emailWithTitle" class="form-label">Revenue Code</label>
                            <input type="email" id="emailWithTitle" class="form-control" placeholder="xxxx@xxx.xx" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
