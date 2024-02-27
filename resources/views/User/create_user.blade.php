@extends('admin_dashboard')
@section('admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Admin /</span> user</h4>

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
                    <form action="" method="get" class="mt-3">
                        @csrf
                        <div class="fieldset">
                            <h1>Search</h1>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 mb-1">
                                    <div class="form-floating">
                                        <select name="user_role" id="user_role" class="form-control">
                                            <option value="">Select option</option>
                                            @foreach ($groupId as $role)
                                                <option value="{{ $role->group_id  }}" {{ old('user_role') == $role->group_id ? 'selected': ''}}>
                                                    {{ $role->group_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="floatingInput">User Role</label>

                                        @error('user_role')
                                        <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-md-6 col-sm-12 mb-1">
                                    <div class="form-floating">
                                        <input type="text" name="name" id="name" value="{{ old('name')}}" placeholder="Username" class="form-control" >
                                        <label for="floatingInput">Name</label>
                                        <div id="floatingInputHelp" class="form-text"></div>

                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12 mb-1">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="email_phone" id="email_phone" value="{{ old('email_phone')}}" placeholder="Username" class="form-control" >
                                        <label for="floatingInput">Email/Phone Number</label>
                                        <div id="floatingInputHelp" class="form-text"></div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12 mb-1">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="to" name="to" placeholder="" />
                                        <label for="floatingInput">From</label>
                                        <div id="floatingInputHelp" class="form-text"> </div>

                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12 mb-1">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="to" name="to" placeholder="" />
                                        <label for="floatingInput">From</label>
                                        <div id="floatingInputHelp" class="form-text"> </div>

                                    </div>
                                </div>
                            </div>

                            {{-- <div id="addw">

                            </div> --}}




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
        </div>


      </div>

      <div class="col-md-12">
        <div class="card mb-4">

          <div class="row">
                <div class="col-6">
                    <h5 class="card-header">User(s)</h5>
                </div>
                <div class="col-6">
                    <div style="text-align: right; padding: 20px">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newRevenue">Add New User</button>
                    </div>
                </div>
            </div>
          <div class="card-body">
            <div class="table-reponsive">
                <table class="table table-stripe">
                    <thead>
                        <tr>
                            {{-- <th>S/N</th> --}}
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                        <tr>
                            <td>{{ $item->name}}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->group_name }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>
                                <div class="dropdown">
                                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                  </button>
                                  <div class="dropdown-menu">
                                    {{-- data-bs-toggle="modal"data-bs-target="#modalCenter" --}}
                                    <a class="dropdown-item" href="javascript:void(0);" onclick="update(
                                        '{{ $item->name }}',
                                        '{{ $item->email }}',
                                        '{{ $item->group_id }}',
                                        '{{ $item->phone }}',
                                        '{{ $item->username }}',
                                        '{{ $item->id }}'
                                    )">
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
   <div class="modal fade" id="edit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Edit User</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('user.edit') }}" method="POST">
                @csrf
                <div class="fieldset">
                    <h1>Update user</h1>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 mb-3">
                            <div class="form-floating">
                                <select name="user_role" id="e_user_role" class="form-control">
                                    <option value="">Select option</option>
                                    @foreach ($groupId as $role)
                                        <option value="{{ $role->group_id  }}" {{ old('user_role') == $role->group_id ? 'selected': ''}}>
                                            {{ $role->group_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="floatingInput">User Role</label>

                                @error('user_role')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>


                        <input type="hidden" name="id" id="id">
                        {{-- <div class="col-md-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input type="text" name="username" id="e_username" value="{{ old('username')}}" placeholder="Username" class="form-control" >
                                <label for="floatingInput">Username</label>
                                <div id="floatingInputHelp" class="form-text"></div>
                                @error('username')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="col-md-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input type="text" name="fullname" id="e_fullname" value="" placeholder="First Name" class="form-control" >
                                <label for="floatingInput">Full name</label>
                                <div id="floatingInputHelp" class="form-text"></div>
                                @error('fullname')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-6 col-sm-12 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="e_email" value="{{ old('email')}}" name="email" placeholder="Email Address"  />
                                <label for="floatingInput">Email</label>
                                <div id="floatingInputHelp" class="form-text"> </div>
                                @error('email')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-6 col-sm-12 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="e_phone_number" value="{{ old('phone_number')}}" name="phone_number" placeholder="Phone Number"  />
                                <label for="floatingInput">Phone Number</label>
                                <div id="floatingInputHelp" class="form-text"> </div>
                                @error('phone_number')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            {{-- <button type="button" class="btn btn-outline-secondary" onclick="add()">Add</button> --}}
                        </div>
                        <div class="col" style="text-align: right">
                            <button type="submit" class="btn btn-primary me-2">SAVE CHANGES</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>

      </div>
    </div>
  </div>


     <!-- Modal -->
     <div class="modal fade" id="newRevenue" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Create user</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.store') }}" method="post">
                    @csrf
                    <div class="fieldset">
                        <h1>Create user</h1>
                        <div class="row">
                            <div class="col-md-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <select name="user_role" id="user_role" class="form-control">
                                        <option value="">Select option</option>
                                        @foreach ($groupId as $role)
                                            <option value="{{ $role->group_id  }}" {{ old('user_role') == $role->group_id ? 'selected': ''}}>
                                                {{ $role->group_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="floatingInput">User Role</label>

                                    @error('user_role')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>



                            {{-- <div class="col-md-6 col-sm-12">
                                <div class="form-floating mb-3">
                                    <input type="text" name="username" id="username" value="{{ old('username')}}" placeholder="Username" class="form-control" >
                                    <label for="floatingInput">Username</label>
                                    <div id="floatingInputHelp" class="form-text"></div>
                                    @error('username')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div> --}}

                            <div class="col-md-6 col-sm-12">
                                <div class="form-floating mb-3">
                                    <input type="text" name="fullname" id="fullname" value="{{ old('fullname')}}" placeholder="First Name" class="form-control" >
                                    <label for="floatingInput">Full name</label>
                                    <div id="floatingInputHelp" class="form-text"></div>
                                    @error('fullname')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="email" value="{{ old('email')}}" name="email" placeholder="Email Address"  />
                                    <label for="floatingInput">Email</label>
                                    <div id="floatingInputHelp" class="form-text"> </div>
                                    @error('email')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="phone_number" value="{{ old('phone_number')}}" name="phone_number" placeholder="Phone Number"  />
                                    <label for="floatingInput">Phone Number</label>
                                    <div id="floatingInputHelp" class="form-text"> </div>
                                    @error('phone_number')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                {{-- <button type="button" class="btn btn-outline-secondary" onclick="add()">Add</button> --}}
                            </div>
                            <div class="col" style="text-align: right">
                                <button type="submit" class="btn btn-primary me-2">SAVE</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            {{-- <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Close
              </button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
          </div>
        </div>
      </div>


  @endsection
  <script>

function update(name, email, group_id, phone, username, id) {

    // console.log()

    // document.getElementById('e_user_role').value = group_id
    $('#e_user_role').val(group_id)
    // $('#e_username').val(username)
    $('#e_fullname').val(name)
    $('#e_email').val(email)
    $('#e_phone_number').val(phone)
    $('#id').val(id)

    let myModal = new bootstrap.Modal(document.getElementById('edit'), {});
    myModal.show();
}


$('#editUser').on('submit', async function(e) {
    e.preventDefault();
    console.log("Hello")
})


// const formF = document.getElementById('editUser');
// // async function submitUpdate
// document.querySelector('#editUser').on('submit', async function(e) {
//     e.preventDeafult();
//     console.log("Hello Pro")
//     const data = new FormData(formF);

//     // let payload = {
//     //     user_role: data.get("user_role")
//     //     username: data.get("username")
//     //     fullname: data.get("fullname")
//     //     email: data.get("email")
//     //     phone_number: data.get("phone_number")
//     // }
//     // console.log(payload)
// })



</script>
  </script>
