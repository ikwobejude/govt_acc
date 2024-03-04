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
                        HEALTH RECORDS OFFICER'S  REGISTRATION BOARD OF NIGERIA <br>
                        FEDERAL  GOVERNMENT OF NIGERIA <br>
                        STATEMENT OF FINANCIAL PERFORMANCE  FOR THE YEAR ENDED 31ST DECEMBER, 2021
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
                                        <td><strong>Total Revenue (a)</strong></td>
                                        <td></td>
                                        <td></td>
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
                                        <td><strong>Total Expenditure (b)</strong></td>
                                        <td></td>
                                        <td></td>
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
                                        <td>
                                            <strong>Surplus/(Deficit) from Ordinary Activities e=(c+d)</strong>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ number_format($dta, 2) }}</td>
                                    </tr>

                                    <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><strong>Surplus/(Deficit) from Operating Activities for the Period c=(a-b)</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ number_format($dta1, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><strong>Net Surplus/ (Deficit) for the Period g=(e-f)</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ number_format($dta1, 2) }}</td>
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
