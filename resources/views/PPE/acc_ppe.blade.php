@extends('admin_dashboard')
@section('admin')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Fixed Assets Register /</span> PPE clase</h4>

        <div class="row">

            <div class="col-md-12">
                <div class="accordion mb-4" id="accordionExample">
                    <div class="card accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                                Search
                            </button>
                        </h2>

                        <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body mt-3">
                                <form action="{{ route('get.ppe') }}" method="get">
                                    @csrf
                                    <div class="fieldset">
                                        <h1>Asset</h1>
                                        <div class="row mb-3">
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text"
                                                        class="form-control"
                                                        id="floatingInput" name="ppename" placeholder="Property, Plant & Equiptment Name"
                                                        value="{{ old('ppename') }}" />
                                                    <label for="floatingInput">Property, Plant & Equiptment Name</label>

                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-floating mb-3">
                                                    <select name="ppeclass" id="ppeclass" class="form-control">
                                                        <option value="">Select option</option>
                                                        @foreach ($ppeClass as $item)
                                                            <option value="{{ $item->classid . '/' . $item->depreciation_type_id }}">
                                                                {{ $item->ppeclass }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="floatingInput">PPE Class</label>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-floating mb-3">
                                                    <select name="ppestate" id="ppestate" class="form-control">
                                                        <option value="">Select option</option>
                                                        @foreach ($state as $item)
                                                            <option value="{{ $item->state_id }}">{{ $item->state }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="floatingInput">PPE State</label>

                                                </div>
                                            </div>

                                            <div class="col-md-7 col-sm-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text"
                                                        class="form-control @error('location') is-invalid @enderror"
                                                        id="floatingInput" name="location" placeholder="Gwarimpa"
                                                        value="{{ old('location') }}" />
                                                    <label for="floatingInput">Property, Plant & Equiptment Location</label>

                                                    @error('location')
                                                        <span class="text-danger"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-5 col-sm-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text"
                                                        class="form-control @error('usefulyears') is-invalid @enderror"
                                                        id="floatingInput" name="usefulyears" placeholder="3"
                                                        value="{{ old('usefulyears') }}"
                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                                                    <label for="floatingInput">Usefull Years</label>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-floating mb-3">
                                                    <input type="date"
                                                        class="form-control"
                                                        id="from" name="from" placeholder=""
                                                        value="{{ old('from') }}" />
                                                    <label for="floatingInput">From</label>

                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-floating mb-3">
                                                    <input type="date"
                                                        class="form-control"
                                                        id="to" name="to" placeholder=""
                                                        value="{{ old('to') }}" />
                                                    <label for="floatingInput">To</label>

                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">

                                            <div class="col-10">.</div>
                                            <div class="col-2" style="text-align: right">
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



            <div class="col-md-12">
                <div class="card mb-4">
                    {{-- <h5 class="card-header"></h5> --}}
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-header">Asset(s)</h5>
                        </div>
                        <div class="col-6">
                            <div style="text-align: right; padding: 20px">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">Add New Asset</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <form action="{{ route('finalization_ppe') }}" method="post">
                                @csrf
                            <table class="table table-stripe">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check form-check-flat mt-0">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" id="checkedAll"
                                                        aria-checked="false"><i class="input-helper"></i> All</label>
                                            </div>
                                        </th>
                                        <th>Action</th>
                                        <th>Asset Name</th>
                                        <th>Description</th>
                                        <th>Asset Class</th>
                                        <th>Asset Class tYPE</th>
                                        <th>Asset State</th>
                                        <th>Location</th>
                                        <th>Warrenty</th>
                                        <th>Userfull Years</th>
                                        <th>Residual Value</th>
                                        <th>Salvage Value</th>
                                        <th>Created By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($acctPPE as $key => $item)
                                        <tr>

                                            <td>
                                                <div class="form-check form-check-flat mt-0">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="checkSingle form-check-input"
                                                            id="checkSingle" aria-checked="false" name="itemid[]"
                                                            value="{{ $item->id }}"><i
                                                            class="input-helper"></i></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                            data-bs-toggle="modal"data-bs-target="#modalCenter1" onclick="update(
                                                                '{{$item->ppename}}',
                                                                '{{$item->ppedesc}}',
                                                                '{{$item->ppeclass}}',
                                                                '{{$item->ppestate}}',
                                                                '{{$item->location}}',
                                                                '{{$item->warranty}}',
                                                                '{{$item->usefulyears}}',
                                                                '{{$item->residualval}}',
                                                                '{{$item->salvage_value}}',
                                                                '{{$item->id}}',
                                                                '{{$item->ppeacct }}'
                                                            )">
                                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                                        </a>
                                                        <a class="dropdown-item" href="{{ route('delete.ppe', $item->id) }}" onclick="confirm('Are you sure you want to deleted')">
                                                            <i class="bx bx-trash me-1"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $item->ppename }}</td>
                                            <td>{{ $item->ppedesc }}</td>
                                            <td>{{ $item->peclass }}</td>
                                            <td>{{ $item->ppesubclass }}</td>
                                            <td>{{ $item->state }}</td>
                                            <td>{{ $item->location }}</td>
                                            <td>{{ $item->warranty }}</td>
                                            <td>{{ $item->usefulyears }}</td>
                                            <td>{{  number_format($item->residualval, 2) }}</td>
                                            <td>{{  number_format($item->salvage_value, 2) }}</td>
                                            <td>{{ $item->name }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="9"><button type="submit"
                                                class="btn btn-primary">Submit for approval</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Add New Asset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('post.ppe') }}" method="post">
                    <div class="modal-body">

                        @csrf
                        <div class="fieldset">
                            <h1>New Asset</h1>
                            <div class="row ">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('ppename') is-invalid @enderror"
                                            id="floatingInput" name="ppename" placeholder="Received From"
                                            value="{{ old('ppename') }}" />
                                        <label for="floatingInput">Property, Plant & Equiptment Name</label>

                                        @error('ppename')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('ppedesc') is-invalid @enderror"
                                            id="floatingInput" name="ppedesc"
                                            placeholder="Description/Details of Receipt"
                                            value="{{ old('description') }}" />
                                        <label for="floatingInput">PPE Description</label>

                                        @error('ppedesc')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-floating mb-3">

                                        <select name="ppeclass" id="ppeclass1" class="form-control" onchange="getRevenueType('assetType', 'ppeclasstypes')">
                                            <option value="">Select option</option>
                                            @foreach ($ppeClass as $item)
                                                <option value="{{ $item->classid }}">
                                                    {{ $item->ppeclass }} </option>
                                            @endforeach
                                        </select>
                                        <label for="floatingInput">Asset Classification</label>

                                        @error('ppeclass')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <span id="co_noti"></span>
                                    <div class="form-floating mb-3">

                                        <select name="ppeclasstypes" id="ppeclasstypes" class="form-control">
                                            <option value="">Select option</option>

                                        </select>
                                        <label for="floatingInput">Asset Classification Type</label>

                                        @error('ppeclass')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <select name="ppestate" id="ppestate" class="form-control">
                                            <option value="">Select option</option>
                                            @foreach ($state as $item)
                                                <option value="{{ $item->state_id }}">{{ $item->state }}</option>
                                            @endforeach
                                        </select>
                                        <label for="floatingInput">PPE State</label>

                                        @error('ppestate')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('location') is-invalid @enderror"
                                            id="floatingInput" name="location" placeholder="Gwarimpa"
                                            value="{{ old('location') }}" />
                                        <label for="floatingInput">Property, Plant & Equiptment Location</label>

                                        @error('location')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="date"
                                            class="form-control @error('warranty') is-invalid @enderror"
                                            id="floatingInput" name="warranty" placeholder=""
                                            value="{{ old('settlement_date') }}" />
                                        <label for="floatingInput">Warranty</label>

                                        @error('warranty')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('usefulyears') is-invalid @enderror"
                                            id="floatingInput" name="usefulyears" placeholder="3"
                                            value="{{ old('usefulyears') }}"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                                        <label for="floatingInput">Usefull Years</label>

                                        @error('usefulyears')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('residualval') is-invalid @enderror"
                                            id="floatingInput" name="residualval" placeholder="Residual Value"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                            value="{{ old('residualval') }}" />
                                        <label for="floatingInput">Residual Value</label>

                                        @error('residualval')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('salvage_value') is-invalid @enderror"
                                            id="floatingInput" name="salvage_value" placeholder="Salvage Value"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                            value="{{ old('salvage_value') }}" />
                                        <label for="floatingInput">Salvage Value</label>
                                        @error('salvage_value')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCenter1" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Update Asset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('put.ppe') }}" method="post">
                    <div class="modal-body">
                        @method('PUT')
                        @csrf
                        <div class="fieldset">
                            <h1>Asset Register</h1>
                            <div class="row ">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="hidden" name="id" id="id">
                                        <input type="text" class="form-control @error('ppename') is-invalid @enderror"
                                            id="eppename" name="ppename" placeholder="Received From"
                                            value="{{ old('ppename') }}" />
                                        <label for="floatingInput">Property, Plant & Equiptment Name</label>

                                        @error('ppename')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('ppedesc') is-invalid @enderror"
                                            id="eppedesc" name="ppedesc"
                                            placeholder="Description/Details of Receipt"
                                            value="{{ old('description') }}" />
                                        <label for="floatingInput">PPE Description</label>

                                        @error('ppedesc')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-floating mb-3">

                                        <select name="ppeclass" id="eppeclass1" class="form-control" onchange="getRevenueType('eassetType', 'eppeclasstypes')">
                                            <option value="">Select option</option>
                                            @foreach ($ppeClass as $item)
                                                <option value="{{ $item->classid }}">
                                                    {{ $item->ppeclass }}</option>
                                            @endforeach
                                        </select>
                                        <label for="floatingInput">Asset Classification</label>

                                        @error('ppeclass')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <span id="eco_noti"></span>
                                    <div class="form-floating mb-3">

                                        <select name="ppeclasstypes" id="eppeclasstypes" class="form-control">
                                            <option value="">Select option</option>
                                            @foreach ($acct_ppe_sub_class as $item)
                                              <option value="{{ $item->id }}"> {{ $item->ppesubclass }} </option>
                                            @endforeach

                                        </select>
                                        <label for="floatingInput">Asset Classification Type</label>

                                        @error('ppeclass')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <select name="ppestate" id="eppestate" class="form-control">
                                            <option value="">Select option</option>
                                            @foreach ($state as $item)
                                                <option value="{{ $item->state_id }}">{{ $item->state }}</option>
                                            @endforeach
                                        </select>
                                        <label for="floatingInput">PPE State</label>

                                        @error('ppestate')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('location') is-invalid @enderror"
                                            id="elocation" name="location" placeholder="Gwarimpa"
                                            value="{{ old('location') }}" />
                                        <label for="floatingInput">Property, Plant & Equiptment Location</label>

                                        @error('location')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="date"
                                            class="form-control @error('warranty') is-invalid @enderror"
                                            id="ewarranty" name="warranty" placeholder=""
                                            value="{{ old('settlement_date') }}" />
                                        <label for="floatingInput">Warranty</label>

                                        @error('warranty')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('usefulyears') is-invalid @enderror"
                                            id="eusefulyears" name="usefulyears" placeholder="3"
                                            value="{{ old('usefulyears') }}"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                                        <label for="floatingInput">Usefull Years</label>

                                        @error('usefulyears')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('residualval') is-invalid @enderror"
                                            id="eresidualval" name="residualval" placeholder="Residual Value"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                            value="{{ old('residualval') }}" />
                                        <label for="floatingInput">Residual Value</label>

                                        @error('residualval')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('salvage_value') is-invalid @enderror"
                                            id="esalvage_value" name="salvage_value" placeholder="Salvage Value"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                            value="{{ old('salvage_value') }}" />
                                        <label for="floatingInput">Salvage Value</label>
                                        @error('salvage_value')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>

    async function getRevenueType(type, id) {
        if(type == "assetType") {
            const lgawait = document.getElementById('co_noti');

            const budget_type = $('#ppeclass1').val()
            console.log(budget_type, "Hello")

            lgawait.textContent = '';
            lgawait.textContent = 'Fetching Items';
            lgawait.style = "color:blue";
            try {
                const res = await fetch('/settings/asset_classificaton_type?asset_class_id='+budget_type);
                const data = await res.json();
                console.log(data)
                if (data.status == false) {
                    lgawait.style = "color:red";
                    lgawait.textContent = data.data;
                } else {
                    lgawait.textContent = ' ';
                    populateLgas(data.data, id)
                }
            } catch (error) {
                lgawait.style = "color:red";
                lgawait.textContent = error.message;
            }
        } else {
            const lgawait = document.getElementById('eco_noti');

            const budget_type = $('#eppeclass1').val()
            lgawait.textContent = '';
            lgawait.textContent = 'Fetching Items';
            lgawait.style = "color:blue";
            try {
                const res = await fetch('/settings/asset_classificaton_type?asset_class_id='+budget_type);
                const data = await res.json();
                // console.log(data)
                if (data.status == false) {
                    lgawait.style = "color:red";
                    lgawait.textContent = data.data;
                } else {
                    lgawait.textContent = ' ';
                    populateLgas(data.data, 'eppeclasstypes')
                }
            } catch (error) {
                lgawait.style = "color:red";
                lgawait.textContent = error.message;
            }
        }


    }



    function populateLgas(data, id) {
        console.log({data})
        if (data.length > 0) {
            var html = "";
            html += "<option disabled selected value> Select option</option>";
            for (var a = 0; a < data.length; a++) {
                html +=
                    '<option value="' + data[a].id +'">' + data[a].ppesubclass + "</option>";
            }
            $("#"+id).html(html);
        } else {
            var html = "";
            html += "<option disabled selected value> No option </option>";
            $("#"+id).html(html);
        }
    }

        function update(ppename, ppedesc, peclass, state, location, warranty, usefulyears, residualval, salvage_value, id, eppeclasstypes) {
            // console.log({ppename, ppedesc, peclass, state, location, warranty, usefulyears, residualval, salvage_value, id})
            $('#id').val(id)
            $('#eppename').val(ppename)
            $('#eppedesc').val(ppedesc)
            $('#eppeclass1').val(peclass)
            $('#eppestate').val(state)
            $('#elocation').val(location)
            $('#ewarranty').val(warranty)
            $('#eusefulyears').val(usefulyears)
            $('#eresidualval').val(residualval)
            $('#esalvage_value').val(salvage_value),
            $('#eppeclasstypes').val(eppeclasstypes)
        }

        function viewDisapproveR(str) {
            document.getElementById('reson').textContent = str;
            console.log(str)
            new bootstrap.Modal(document.querySelector("#reason")).show();
        }


        window.addEventListener('load', function() {
            console.log("Helo")
            $("#checkedAll").change(function() {
                if (this.checked) {
                    $(".checkSingle").each(function() {
                        this.checked = true;
                    });
                } else {
                    $(".checkSingle").each(function() {
                        this.checked = false;
                    });
                }
            });

            $(".checkSingle").click(function() {
                if ($(this).is(":checked")) {
                    var isAllChecked = 0;
                    $(".checkSingle").each(function() {

                        if (!this.checked) isAllChecked = 1;
                    });

                    if (isAllChecked == 0) {
                        $("#checkedAll").prop("checked", true);
                    }

                } else {
                    $("#checkedAll").prop("checked", false);
                }
            });
        });
    </script>
@endsection


