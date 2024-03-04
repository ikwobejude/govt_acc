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
                                    @foreach ($revenue as $item)
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
                                        <td colspan="5">
                                            <strong>Outflows</strong>
                                        </td>
                                    </tr>

                                    @foreach ($ExpenditureRegister as $item)
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
                                        <td colspan="5">
                                            <strong>CASH FLOW FROM INVESTING ACTIVITIES</strong>
                                        </td>
                                    </tr>
                                    @foreach ($asset as $item)
                                    <tr>
                                        <td>{{ $item->line }}</td>
                                        <td></td>
                                        <td>{{ $item->code }}</td>
                                        <td></td>
                                        <td>{{ number_format($item->total, 2) }}</td>
                                        <td></td>
                                    </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>






        </div>
    </div>



@endsection
