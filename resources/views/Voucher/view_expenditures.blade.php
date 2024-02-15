@extends('admin_dashboard')
@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Revenue Receipt /</span> Voucher</h4>

    <div class="row">

      <div class="col-md-12">
        <div class="card mb-4">
          {{-- <h5 class="card-header">Revenue(s)</h5> --}}
          <div class="card-body">
            <form action="{{ route('post.revenue') }}" method="post">
                @csrf
                <div class="fieldset">
                    <h1>Search</h1>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <select name="batch_type" id="batch_type" class="form-control @error('batch_type') is-invalid @enderror">
                                    <option value="">-- Select Option --</option>
                                    <option value="Employee">Employee</option>
                                    <option value="Vendor">Vendor</option>
                                </select>
                                <label for="floatingInput">Batch Type</label>
                                <div id="floatingInputHelp" class="form-text"></div>
                                @error('batch_type')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="date" name="date" id="date" class="form-control" >
                                <label for="floatingInput">Date</label>
                                <div id="floatingInputHelp" class="form-text"></div>
                                @error('batch_type')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('authority_document_ref_no') is-invalid @enderror" id="floatingInput" name="authority_document_ref_no" placeholder="Authority Document Ref. No" value="{{ old('authority_document_ref_no')}}" />
                                <label for="floatingInput">Authority Document Ref. No</label>

                                @error('authority_document_ref_no')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInput" name="name" placeholder="Year" value="" />
                                <label for="floatingInput">Paid to</label>
                                <div id="floatingInputHelp" class="form-text"> </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <div class="form-floating mb-3">
                                <select name="expenditure_type" id="expenditure_type" class="form-control @error('batch_type') is-invalid @enderror">
                                    <option value="">-- Select Option --</option>
                                    @foreach ($expenditureType as $Etype)
                                    <option value="{{ $Etype->type }}">{{ $Etype->type }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingInput">EXPENDITURE TYPE</label>
                                <div id="floatingInputHelp" class="form-text"></div>
                            </div>
                        </div>

                    </div>






                    <div class="row">
                        <div class="col">
                            {{-- <button type="button" class="btn btn-outline-secondary" onclick="add()">Add</button> --}}
                        </div>
                        <div class="col" style="text-align: right">
                            <button type="submit" class="btn btn-primary me-2">Search</button>
                        </div>
                    </div>
                </div>


            </form>

          </div>
        </div>
      </div>

      <div class="col-md-12">
        <div class="card mb-4">
          <h5 class="card-header">Expenditure(s)</h5>
          <div class="card-body">
            <table class="table table-stripe">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Batch Name</th>
                        <th>Expenditure Type</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ExpenditureRegister as  $key=>$item)
                        <tr>
                            <td>{{ $key + 1}}</td>
                            <td> {{ $item->batch_name }} </td>
                            <td> {{ $item->expenditure_type }} </td>
                            <td> {{ $item->name }} </td>
                            <td> {{ $item->amount }}</td>
                            <td> {{ $item->narration }} </td>
                            <td> {{ $item->approved_on }}</td>

                            <td>
                                <a href="{{ route('view.voucher', $item->idexpenditure_payregister) }}" class="btn btn-outline-secondary">Voucher</a>
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


  @endsection
