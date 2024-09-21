@extends('admin_dashboard')
<style>
    .td {
        border: 1px solid black;
        border-top: 1px solid black
    }
    .underline {
        border-bottom: 2px solid black;
        border-top: 2px solid black;
    }
</style>
@section('admin')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span>Statement of Financial Position</h4>

        <div class="row">
            <div class="col-md-9">
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


            <div class="col-md-9">
                <div class="card mb-4">

                    <h5 class="card-header" style="text-align: center">
                        HEALTH RECORDS OFFICERS REGISTRATION BOARD OF NIGERIA <br>
                        Note (Disclosure) to the Financial Statements for  {{ strtoupper(explode(" ", $from)[0]) ." - ".strtoupper(explode(" ", $to)[0]) }}. <br>
                    </h5>
                        
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 pb-3" style="text-align: right">
                                <a href="{{ route('download.financial_position', ['from'=>$from, 'to'=>$to]) }}" class="btn btn-primary">Download to Excel</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-stripe">
                                <thead>

                                    <tr>
                                        <th style="width: 5%"><strong>NOTES</strong></th>
                                        <th><strong></strong></th>

                                        <th><strong>2024</strong></th>
                                    </tr>


                                </thead>

                                <tbody>
                                    {{-- Note 3 Inventories --}}
                                    <tr>
                                        <td><b>3</b></td>
                                        <td><b>Inventories</b></td>
                                        <td></td>
                                    </tr>

                                    <?php $inventory = 0; ?>
                                    @foreach ($inventories as $invent)
                                    <?php $inventory += $invent->total; ?>
                                    <tr>
                                        <td></td>
                                        <td>{{ $invent->line}}</td>
                                        <td>{{ number_format($invent->total, 2) }}</td>
                                    </tr>
                                    @endforeach
                                    <tr >
                                        <td></td>
                                        <td></td>
                                        <td class="underline">{{ number_format($inventory, 2) }}</td>
                                    </tr>


                                    <tr>
                                        <td><b>5</b></td>
                                        <td><b>Payable</b></td>
                                        <td></td>
                                    </tr>

                                    <?php $pay_able_total = 0; ?>
                                    @foreach ($payable as $pay)
                                    <?php $pay_able_total += $pay->payable_amount; ?>
                                    <tr>
                                        <td></td>
                                        <td>{{ $pay->payable_to}}</td>
                                        <td>{{ number_format($pay->payable_amount, 2) }}</td>
                                    </tr>
                                    @endforeach

                                    <tr >
                                        <td></td>
                                        <td></td>
                                        <td class="underline">{{ number_format($pay_able_total, 2) }}</td>
                                    </tr>


                                    <tr>
                                        <td><b>6</b></td>
                                        <td><b>Recurrent Grant</b></td>
                                        <td></td>
                                    </tr>

                                    <?php $recurent_grant_t = 0; ?>
                                    @foreach ($revenue_records as $recurent)

                                        @if ($recurent->note == 6)
                                        <?php $recurent_grant_t += $recurent->total; ?>
                                            <tr>
                                                <td></td>
                                                <td>{{ $recurent->line }}</td>
                                                <td>{{ number_format($recurent->total, 2) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="underline">{{ number_format($recurent_grant_t, 2) }}</td>
                                    </tr>


                                    <tr>
                                        <td><b>7</b></td>
                                        <td><b>Internally generated Revenue</b></td>
                                        <td></td>
                                    </tr>

                                    <?php $internally_gen_total = 0; ?>
                                    @foreach ($revenue_records as $internally)

                                        @if ($internally->note == 7)
                                        <?php $internally_gen_total += $internally->total; ?>
                                            <tr>
                                                <td></td>
                                                <td>{{ $internally->line }}</td>
                                                <td>{{ number_format($internally->total, 2) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="underline">{{ number_format($internally_gen_total, 2) }}</td>
                                    </tr>

                                    <tr>
                                        <td><b>8</b></td>
                                        <td><b>Capital Grant</b></td>
                                        <td></td>
                                    </tr>

                                    <?php $capital_grant_total = 0; ?>
                                    @foreach ($assets as $asset)

                                        @if ($asset->note == 7)
                                        <?php $capital_grant_total += $asset->total; ?>
                                            <tr>
                                                <td></td>
                                                <td>{{ $asset->line }}</td>
                                                <td>{{ number_format($asset->total, 2) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="underline">{{ number_format($capital_grant_total, 2) }}</td>
                                    </tr>

                                    <tr>
                                        <td><b>9</b></td>
                                        <td><b>Operating Expenses</b></td>
                                        <td></td>
                                    </tr>

                                    <?php $operating_exp = 0; ?>
                                    @foreach ($note_9 as $note)
                                        <?php $operating_exp += $note->total; ?>
                                        <tr>
                                            <td></td>
                                            <td>{{ $note->line }}</td>
                                            <td>{{ number_format($note->total, 2) }}</td>
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="underline">{{ number_format($operating_exp, 2) }}</td>
                                    </tr>


                                    <tr>
                                        <td><b>10</b></td>
                                        <td><b>Administrative Expense</b></td>
                                        <td></td>
                                    </tr>

                                    <?php $admin_expenses = 0; ?>
                                    @foreach ($administrative as $admin)
                                        @if ($admin->note == 12 || $admin->note == 13 || $admin->note == 14 || $admin->note == 15 || $admin->note == 16 || $admin->note == 17 || $admin->note == 18 || $admin->note == 19 || $admin->note == 20 || $admin->note == 21 || $admin->note == 22 || $admin->note == 23)
                                            <?php $admin_expenses += $admin->total; ?>
                                            <tr>
                                                <td></td>
                                                <td>{{
                                                    ($admin->note == 12 ? "Travel & Transport (Note 12)" :
                                                    ($admin->note == 13 ? "Utility (Note 13)" :
                                                    ($admin->note == 14 ? "Material & Supplies (Note 14)" :
                                                    ($admin->note == 15 ? "Maintenance services (Note 15)" :
                                                    ($admin->note == 16 ? "Training (Note 16)" :
                                                    ($admin->note == 17 ? "Other services (Note 17)" :
                                                    ($admin->note == 18 ? "Consulting and legal services (Note 18)" :
                                                    ($admin->note == 19 ? "Fuel & Lubricants (Note 19)" :
                                                    ($admin->note == 20 ? "Financial charges (Note 20)" :
                                                    ($admin->note == 21 ? "Miscellaneous Expenses (Note 21)" :
                                                    ($admin->note == 22 ? "Depreciation charges (Note 22)" :
                                                    ($admin->note == 23 ? "Amoritization (Note 23)" : "" ) )))))))))))
                                                }}</td>
                                                <td>{{ number_format($admin->total, 2) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="underline">{{ number_format($admin_expenses, 2) }}</td>
                                    </tr>


                                    <tr>
                                        <td><b>11</b></td>
                                        <td><b>Personnel cost</b></td>
                                        <td></td>
                                    </tr>

                                    <?php $personnel_cost_total = 0; ?>
                                    @foreach ($expenditures as $p_cost)
                                        @if ($p_cost->note == 11)
                                            <?php $personnel_cost_total += $p_cost->total; ?>
                                            <tr>
                                                <td></td>
                                                <td>{{ $p_cost->line }}</td>
                                                <td>{{ number_format($p_cost->total, 2) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="underline">{{ number_format($personnel_cost_total, 2) }}</td>
                                    </tr>


                                    <tr>
                                        <td><b>12</b></td>
                                        <td><b>Travel & Transport </b></td>
                                        <td></td>
                                    </tr>

                                    <?php $travle_transport_total = 0; ?>
                                    @foreach ($expenditures as $tp)
                                        @if ($tp->note == 12)
                                            <?php $travle_transport_total += $tp->total; ?>
                                            <tr>
                                                <td></td>
                                                <td>{{ $tp->line }}</td>
                                                <td>{{ number_format($tp->total, 2) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="underline">{{ number_format($travle_transport_total, 2) }}</td>
                                    </tr>

                                    <tr>
                                        <td><b>13</b></td>
                                        <td><b>Utility </b></td>
                                        <td></td>
                                    </tr>

                                    <?php $utility = 0; ?>
                                    @foreach ($expenditures as $tp)
                                        @if ($tp->note == 13)
                                            <?php $utility += $tp->total; ?>
                                            <tr>
                                                <td></td>
                                                <td>{{ $tp->line }}</td>
                                                <td>{{ number_format($tp->total, 2) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="underline">{{ number_format($utility, 2) }}</td>
                                    </tr>


                                    <tr>
                                        <td><b>14</b></td>
                                        <td><b>Material & Supplies </b></td>
                                        <td></td>
                                    </tr>

                                    <?php $material = 0; ?>
                                    @foreach ($expenditures as $tp)
                                        @if ($tp->note == 14)
                                            <?php $material += $tp->total; ?>
                                            <tr>
                                                <td></td>
                                                <td>{{ $tp->line }}</td>
                                                <td>{{ number_format($tp->total, 2) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="underline">{{ number_format($material, 2) }}</td>
                                    </tr>


                                    <tr>
                                        <td><b>15</b></td>
                                        <td><b>Maintenance Service </b></td>
                                        <td></td>
                                    </tr>

                                    <?php $maintenance = 0; ?>
                                    @foreach ($expenditures as $tp)
                                        @if ($tp->note == 15)
                                            <?php $maintenance += $tp->total; ?>
                                            <tr>
                                                <td></td>
                                                <td>{{ $tp->line }}</td>
                                                <td>{{ number_format($tp->total, 2) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="underline">{{ number_format($maintenance, 2) }}</td>
                                    </tr>


                                    <tr>
                                        <td><b>16</b></td>
                                        <td><b>Training </b></td>
                                        <td></td>
                                    </tr>

                                    <?php $training = 0; ?>
                                    @foreach ($expenditures as $tp)
                                        @if ($tp->note == 16)
                                            <?php $training += $tp->total; ?>
                                            <tr>
                                                <td></td>
                                                <td>{{ $tp->line }}</td>
                                                <td>{{ number_format($tp->total, 2) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="underline">{{ number_format($training, 2) }}</td>
                                    </tr>


                                    <tr>
                                        <td><b>17</b></td>
                                        <td><b>Other Services </b></td>
                                        <td></td>
                                    </tr>

                                    <?php $other_service = 0; ?>
                                    @foreach ($expenditures as $tp)
                                        @if ($tp->note == 17)
                                            <?php $other_service += $tp->total; ?>
                                            <tr>
                                                <td></td>
                                                <td>{{ $tp->line }}</td>
                                                <td>{{ number_format($tp->total, 2) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="underline">{{ number_format($other_service, 2) }}</td>
                                    </tr>


                                    <tr>
                                        <td><b>18</b></td>
                                        <td><b>Consulting and legal services </b></td>
                                        <td></td>
                                    </tr>

                                    <?php $legal_service = 0; ?>
                                    @foreach ($expenditures as $tp)
                                        @if ($tp->note == 18)
                                            <?php $legal_service += $tp->total; ?>
                                            <tr>
                                                <td></td>
                                                <td>{{ $tp->line }}</td>
                                                <td>{{ number_format($tp->total, 2) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="underline">{{ number_format($legal_service, 2) }}</td>
                                    </tr>

                                    <tr>
                                        <td><b>19</b></td>
                                        <td><b>Fuel & Lubricants </b></td>
                                        <td></td>
                                    </tr>

                                    <?php $lubricant = 0; ?>
                                    @foreach ($expenditures as $tp)
                                        @if ($tp->note == 19)
                                            <?php $lubricant += $tp->total; ?>
                                            <tr>
                                                <td></td>
                                                <td>{{ $tp->line }}</td>
                                                <td>{{ number_format($tp->total, 2) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="underline">{{ number_format($lubricant, 2) }}</td>
                                    </tr>


                                    <tr>
                                        <td><b>20</b></td>
                                        <td><b>Financial charges </b></td>
                                        <td></td>
                                    </tr>

                                    <?php $financial_charges = 0; ?>
                                    @foreach ($expenditures as $tp)
                                        @if ($tp->note == 20)
                                            <?php $financial_charges += $tp->total; ?>
                                            <tr>
                                                <td></td>
                                                <td>{{ $tp->line }}</td>
                                                <td>{{ number_format($tp->total, 2) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="underline">{{ number_format($financial_charges, 2) }}</td>
                                    </tr>


                                    <tr>
                                        <td><b>21</b></td>
                                        <td><b>Miscellaneous Expenses </b></td>
                                        <td></td>
                                    </tr>

                                    <?php $miscellaneous = 0; ?>
                                    @foreach ($expenditures as $tp)
                                        @if ($tp->note == 21)
                                            <?php $miscellaneous += $tp->total; ?>
                                            <tr>
                                                <td></td>
                                                <td>{{ $tp->line }}</td>
                                                <td>{{ number_format($tp->total, 2) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="underline">{{ number_format($miscellaneous, 2) }}</td>
                                    </tr>

                                    <tr>
                                        <td><b>22</b></td>
                                        <td><b>Depreciation charges </b></td>
                                        <td></td>
                                    </tr>

                                    <?php $depreciation = 0; ?>
                                    @foreach ($expenditures as $tp)
                                        @if ($tp->note == 22)
                                            <?php $depreciation += $tp->total; ?>
                                            <tr>
                                                <td></td>
                                                <td>{{ $tp->line }}</td>
                                                <td>{{ number_format($tp->total, 2) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="underline">{{ number_format($depreciation, 2) }}</td>
                                    </tr>

                                    <tr>
                                        <td><b>23</b></td>
                                        <td><b>Amoritization </b></td>
                                        <td></td>
                                    </tr>

                                    <?php $amoritization = 0; ?>
                                    @foreach ($expenditures as $tp)
                                        @if ($tp->note == 23)
                                            <?php $amoritization += $tp->total; ?>
                                            <tr>
                                                <td></td>
                                                <td>{{ $tp->line }}</td>
                                                <td>{{ number_format($tp->total, 2) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="underline">{{ number_format($amoritization, 2) }}</td>
                                    </tr>


                                    <tr>
                                        <td><b>24</b></td>
                                        <td><b>Remittance to CRF </b></td>
                                        <td></td>
                                    </tr>

                                    <?php $remittance = 0; ?>
                                    @foreach ($expenditures as $tp)
                                        @if ($tp->note == 24)
                                            <?php $remittance += $tp->total; ?>
                                            <tr>
                                                <td></td>
                                                <td>{{ $tp->line }}</td>
                                                <td>{{ number_format($tp->total, 2) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="underline">{{ number_format($remittance, 2) }}</td>
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
