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
                                        <th></th>
                                        <th colspan="2">NOTE</th>
                                    </tr>
                                    <tr>
                                        <th>ASSET</th>
                                        <th colspan="2"></th>
                                    </tr>

                                </thead>

                                <tbody>
                                 <?php
                                    $count = 0;
                                    $assetsum = 0;
                                    $liabilitySum = 0;
                                    $totalEquity = 0;
                                  ?>
                                  @foreach ($asset->groupBy('assest_type') as $assest_type => $rev)

                                  <tr>
                                      <td>{{ $assest_type }}</td>
                                      <td></td>
                                      <td>2024</td>
                                  </tr>

                                    @foreach ($rev as $key => $item)
                                    <?php
                                    $count++;
                                    $assetsum += (float)$item->opening_value;
                                    ?>
                                    <tr>
                                        {{-- <td>{{ $key + 1}}</td> --}}
                                        <td class="td"> {{ $item->assest_name }} </td>
                                        <td class="td"> {{ $count }} </td>
                                        <td class="td">{{ number_format($item->opening_value, 2) }} </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2"> {{ "TOTAL ".strtoupper($assest_type)." ASSET" }}</td>
                                        <td>{{ number_format($assetsum, 2) }}</td>
                                    </tr>
                                  @endforeach

                                  <tr>
                                        <th>Liability</th>
                                        <th colspan="2"></th>
                                  </tr>

                                  @foreach ($liability->groupBy('type_of_liability') as $type_of_liability => $rev)

                                  <tr>
                                      <td>{{ $type_of_liability }}</td>
                                      <td></td>
                                      <td>2024</td>
                                  </tr>

                                    @foreach ($rev as $key => $item)
                                    <?php
                                        $count++;
                                        $liabilitySum += (float)$item->amount;
                                    ?>
                                    <tr>
                                        {{-- <td>{{ $key + 1}}</td> --}}
                                        <td class="td"> {{ $item->liability }} </td>
                                        <td class="td"> {{ $count }} </td>
                                        <td class="td">{{ number_format($item->amount, 2) }} </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2"> {{ "TOTAL ".strtoupper($type_of_liability)." LIABILITY" }}</td>
                                        <td>{{ number_format($liabilitySum, 2) }}</td>
                                    </tr>
                                  @endforeach


                                  <tr>
                                    <th>EQUITY</th>
                                    <th colspan="2"></th>
                              </tr>



                                @foreach ($revenue as $key => $item)
                                <?php
                                    $count++;
                                    $totalEquity += (float)$item->revenue_amount;
                                ?>
                                <tr>
                                    {{-- <td>{{ $key + 1}}</td> --}}
                                    <td class="td"> {{ $item->received_from }} </td>
                                    <td class="td"> {{ $count }} </td>
                                    <td class="td">{{ number_format($item->revenue_amount, 2) }} </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2"> TOTAL EQUITY</td>
                                    <td>{{ number_format($totalEquity, 2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2"> TOTAL EQUITY AND LIABILITY</td>
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
