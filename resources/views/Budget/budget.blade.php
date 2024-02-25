@extends('admin_dashboard')


@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Account /</span> Budgeting</h4>

    <div class="row">
      <div class="col-md-12 mb-3">
        <div class="accordion mt-3" id="accordionExample">
            <div class="card accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                  Search
                </button>
              </h2>

              <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="" method="get" class="mt-3">
                        @csrf
                        <div class="fieldset">
                            <h1>Search</h1>
                            <div class="row mb-3">
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <div class="form-floating">
                                        <select name="budgetType" id="sbudgetType" class="form-control" onchange="getRevenueType('sbudgetType')">
                                            <option value="">Select option</option>
                                            <option value="2">Personnel</option>
                                            <option value="3">Overhead</option>
                                            <option value="4">Capital</option>
                                        </select>
                                        <label for="floatingInput">Budget Type<span class="required">*</span></label>

                                        @error('budgetType')
                                        <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <span id="seco_noti"></span>
                                    <div class="form-floating">
                                        <select name="economicCode" id="seconomicCode" class="form-control">
                                            <option value="">Select option</option>

                                        </select>
                                        <label for="floatingInput">Economic Code<span class="required">*</span></label>

                                        @error('economicCode')
                                        <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-12 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control " id="project" name="project" placeholder="Received From" value="{{ old('project')}}" />
                                        <label for="floatingInput">Project</label>
                                    </div>
                                </div>


                                <div class="col-md-4 col-sm-12 mb-3">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="from" name="from" placeholder="" value="{{ old('dateFrom')}}" />
                                        <label for="floatingInput">From</label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 mb-3">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="to" name="to" placeholder="" value="{{ old('dateTo')}}" />
                                        <label for="floatingInput">To</label>
                                    </div>
                                </div>


                                <div class="modal-footer" >
                                    <button type="submit" class="btn btn-primary me-2">Search</button>
                                    {{-- <button type="reset" class="btn btn-outline-secondary">Discard</button> --}}
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
            <div class="row">
                <div class="col-6">
                    <h3 class="card-header mt-3">Budgeting</h3>
                </div>
                <div class="col-6">
                    <div style="text-align: right; padding: 20px">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newRevenue">Add new revenue</button>
                    </div>
                </div>
            </div>


          <div class="card-body">
            <div class="table-responsive">
                <table class="table table-stripe">
                    <thead>
                        <tr>
                            <th colspan="2"><u>Economic Code (Line Item)</u></th>
                            <th>Fund Sources </th>
                            <th>Project</th>
                            <th>Current Budget </th>
                            <th>Remaining Balance </th>
                            <th>Change (+/-) </th>
                            <th>Revised Budget</th>
                            <th>Budget Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($budges as  $key=>$item)
                            <tr>
                                <td>{{ $item->economic_code }}</td>
                                <td>{{ $item->line }}</td>
                                <td>{{ $item->found_source }}</td>
                                <td>{{ $item->project }}</td>
                                <td>{{ number_format($item->current_budget, 2) }}</td>
                                <td>{{ number_format($item->current_budget, 2) }}</td>
                                <td>{{ $item->change }}</td>
                                <td>{{ number_format($item->current_budget, 2) }}</td>
                                <td>
                                    @if($item->budget_type == 2)
                                        <span class="badge bg-label-success">Personel</span>
                                    @endif
                                    @if($item->budget_type == 3)
                                        <span class="badge bg-label-primary">Overhead</span>
                                    @endif
                                    @if($item->budget_type == 4)
                                        <span class="badge bg-label-info">Capital</span>
                                    @endif

                                </td>
                                <td>
                                    <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                      </button>
                                      <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"data-bs-target="#modalCenter">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                      </div>
                                    </div>
                                </td>
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


   <!-- Modal -->
   <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label for="nameWithTitle" class="form-label">Revenue Line</label>
              <input
                type="text"
                id="nameWithTitle"
                class="form-control"
                placeholder="Enter Name" />
            </div>
          </div>
          <div class="row g-2">
            <div class="col mb-0">
              <label for="emailWithTitle" class="form-label">Revenue Code</label>
              <input
                type="email"
                id="emailWithTitle"
                class="form-control"
                placeholder="xxxx@xxx.xx" />
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

     <!-- Modal -->
     <div class="modal fade" id="newRevenue" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">New Budget</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('store.budget') }}" method="post" id="budgeting">
                    @csrf
                    <div class="fieldset">
                        <h1>Budget</h1>
                        <div class="row mb-3">
                            <div class="col-md-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <select name="budgetType" id="budgetType" required class="form-control" onchange="getRevenueType('budgetType')">
                                        <option value="">Select option</option>
                                        <option value="2">Personnel</option>
                                        <option value="3">Overhead</option>
                                        <option value="4">Capital</option>
                                    </select>
                                    <label for="floatingInput">Budget Type<span class="required">*</span></label>

                                    @error('budgetType')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <span id="eco_noti"></span>
                                <div class="form-floating">
                                    <select name="economicCode" id="economicCode" required class="form-control">
                                        <option value="">Select option</option>

                                    </select>
                                    <label for="floatingInput">Economic Code<span class="required">*</span></label>

                                    @error('economicCode')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <input type="text" required class="form-control @error('received_from') is-invalid @enderror" id="project" name="project" placeholder="Project" value="{{ old('project')}}" />
                                    <label for="floatingInput">Project<span class="required">*</span></label>

                                    @error('project')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-4 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <input type="text" required
                                    class="form-control @error('received_from') is-invalid @enderror"
                                    id="current_budget" name="current_budget" placeholder="Received From"
                                    value="{{ old('current_budget')}}"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                                    <label for="floatingInput">Current Budget<span class="required">*</span></label>

                                    @error('current_budget')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <input type="text" required
                                    class="form-control @error('received_from') is-invalid @enderror"
                                    id="actual_expenditure" name="actual_expenditure"
                                    placeholder="Actual Expenditure" value="{{ old('actual_expenditure')}}"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                                    <label for="floatingInput">Actual Expenditure<span class="required">*</span></label>

                                    @error('current_budget')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                        </div>




                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                              Close
                            </button>
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                    </div>

                </form>
            </div>

          </div>
        </div>
      </div>
    </div>








  <script>


    async function getRevenueType(type) {
        if(type == "budgetType") {
            const lgawait = document.getElementById('eco_noti');

            const budget_type = $('#budgetType').val()
            lgawait.textContent = '';
            lgawait.textContent = 'Fetching Items';
            lgawait.style = "color:blue";
            try {
                const res = await fetch('/settings/economic_lines?type='+budget_type);
                const data = await res.json();
                console.log(data)
                if (data.status == false) {
                    lgawait.style = "color:red";
                    lgawait.textContent = data.data;
                } else {
                    lgawait.textContent = ' ';
                    populateLgas(data.data, "economicCode")
                }
            } catch (error) {
                lgawait.style = "color:red";
                lgawait.textContent = error.message;
            }
        } else {
            const lgawait = document.getElementById('seco_noti');

            const budget_type = $('#sbudgetType').val()
            lgawait.textContent = '';
            lgawait.textContent = 'Fetching Items';
            lgawait.style = "color:blue";
            try {
                const res = await fetch('/settings/economic_lines?type='+budget_type);
                const data = await res.json();
                console.log(data)
                if (data.status == false) {
                    lgawait.style = "color:red";
                    lgawait.textContent = data.data;
                } else {
                    lgawait.textContent = ' ';
                    populateLgas(data.data, 'seconomicCode')
                }
            } catch (error) {
                lgawait.style = "color:red";
                lgawait.textContent = error.message;
            }
        }


    }



    function populateLgas(data, id) {
        console.log(data)
        if (data.length > 0) {
            var html = "";
            html += "<option disabled selected value> Select option</option>";
            for (var a = 0; a < data.length; a++) {
                html +=
                    '<option value="' + data[a].type +','+ data[a].economic_code +','+ data[a].description + ' ">' + data[a].description +'::'+ data[a].economic_code + "</option>";
            }
            $("#"+id).html(html);
        } else {
            var html = "";
            html += "<option disabled selected value> No option </option>";
            $("#"+id).html(html);
        }
    }

    @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}";
        console.log(type)
        if(type == "error"){
            // $('#newRevenue').modal('show')
            let myModal = new bootstrap.Modal(document.getElementById('newRevenue'), {});
            // myModal.show();
        }
    @endif

 </script>
  @endsection


