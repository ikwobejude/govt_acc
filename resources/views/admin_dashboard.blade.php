<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.png') }}" />

    <!-- Fonts -->
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin /> --}}
    {{-- <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" /> --}}

    <link rel="stylesheet" href="{{ asset('back/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('back/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('back/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('back/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('back/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('back/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->



     <!-- Toaster js -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <!--End Toaster js -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


  <style>
    .fieldset {
      position: relative;
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 20px;
    }

    .fieldset h1 {
      position: absolute;
      top: 0;
      font-size: 18px;
      line-height: 1;
      margin: -9px 0 0;
      /* half of font-size */
      background: #fff;
      padding: 0 3px;
    }

    /* Style all input fields */

    /* The message box is shown when the user clicks on the password field */
    #message {
      display: none;
      background: #f1f1f1;
      color: #000;
      position: relative;
      padding: 20px;
      margin-top: 10px;
    }

    #message p {
      padding: 10px 35px;
      font-size: 18px;
    }

    /* Add a green text color and a checkmark when the requirements are right */
    .valid {
      color: green;
    }

    .valid:before {
      position: relative;
      left: -35px;
      content: "✔";
    }

    /* Add a red text color and an "x" when the requirements are wrong */
    .invalid {
      color: red;
    }

    .invalid:before {
      position: relative;
      left: -35px;
      content: "✖";
    }

    .td {
      width: 20px
    }

       /* spinner */
   #cover-spin {
        position:fixed;
        width:100%;
        left:0;right:0;top:0;bottom:0;
        background-color: rgba(255,255,255,0.7);
        z-index:9999;
        display:none;
    }
    @-webkit-keyframes spin {
      from {
        -webkit-transform: rotate(0deg);
      }

      to {
        -webkit-transform: rotate(360deg);
      }
    }

    @keyframes spin {
      from {
        transform: rotate(0deg);
      }

      to {
        transform: rotate(360deg);
      }
    }

    #cover-spin::after {
      content: '';
      display: block;
      position: absolute;
      left: 48%;
      top: 40%;
      width: 40px;
      height: 40px;
      border-style: solid;
      border-color: black;
      border-top-color: transparent;
      border-width: 4px;
      border-radius: 50%;
      -webkit-animation: spin .8s linear infinite;
      animation: spin .8s linear infinite;
    }


    .required {
        color: red
    }


    .select2-selection__rendered {
        line-height: 31px !important;
    }
    .select2-container .select2-selection--single {
        height: 45px !important;
    }
    .select2-selection__arrow {
        height: 45px !important;
    }

    .slt {
        width: 100%;
    }

    /* .select2-container .select2-selection {
        height: 34px;
    } */
</style>
  <!-- End Sweet Alert -->
</head>

<!-- body start -->

<body>

<div id="cover-spin"></div>
   <!-- Layout wrapper -->
   <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <!-- Menu -->
            @include('body.side_bar')
            <!-- / Menu -->


            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('body.nav')
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    {{-- @yield('alerts') --}}
                    <div class="container-xxl">
                        <div class="row">
                            <div class="col-12 pt-2">
                                @if(Session::has('message'))
                                    <?php $type = Session::get('alert-type') ?>
                                    {{-- var type = "{{ Session::get('alert-type','info') }}" --}}
                                    @switch($type)
                                        @case('info')
                                                <div class="clearfix"></div>
                                                <div class="alert alert-info" role="alert">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                    {{ Session::get('message') }}
                                                </div>
                                            @break
                                        @case('success')
                                                <div class="clearfix"></div>
                                                <div class="alert alert-success" role="alert">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                    {{ Session::get('message') }}
                                                </div>
                                            @break
                                        @case('warning')
                                                <div class="clearfix"></div>
                                                <div class="alert alert-warning" role="alert">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                    {{ Session::get('message') }}
                                                </div>
                                            @break
                                        @case('error')
                                                <div class="clearfix"></div>
                                                <div class="alert alert-danger" role="alert">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                    {{ Session::get('message') }}
                                                </div>
                                            @break
                                    @endswitch
                                @endif

                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <p><strong>Opps Something went wrong</strong></p>
                                        <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                        </ul>
                                    </div>
                                @endif

                            </div>
                        </div>

                    </div>
                    @yield('admin')


                    <footer class="content-footer footer bg-footer-theme">
                        @include('body.footer')
                    </footer>

                    <div class="content-backdrop fade"></div>

                </div>
                <!-- / Content wrapper -->
            </div>
            <!--/ Layout container -->
            <!-- end Topbar -->


        </div>
          <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
  <!-- / Layout wrapper -->

    <!-- Helpers -->
    <script src="{{ asset('back/assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('back/assets/js/config.js') }}"></script>
  <script src="{{ asset('back/assets/vendor/libs/jquery/jquery.js') }}"></script>

  {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> --}}
  <script src="{{ asset('back/assets/vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('back/assets/vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('back/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('back/assets/vendor/js/menu.js') }}"></script>

  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="{{ asset('back/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

  <!-- Main JS -->
  <script src="{{ asset('back/assets/js/main.js') }}"></script>

  <!-- Page JS -->
  <script src="{{ asset('back/assets/js/dashboards-analytics.js') }}"></script>

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>





  <!-- jquery cdn -->

  {{-- select  --}}
  {{-- <script src="{{ asset('backendassets/libs/select2/js/select2.min.js') }}"></script> --}}
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
  <!-- jquery cdn ends -->

  {{-- <script src="{{ asset('js/jquery_easy_session_timeout.js') }}"></script> --}}


  <!-- toaster js -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


  <script>
    $('#select').select2({
        width: 'resolve',
        theme: "classic",
        dropdownParent: $('#addModal')
    });

    $('#select1').select2({
        width: 'resolve',
        theme: "classic",
        dropdownParent: $('#addModal')
    });

    $('#select2').select2({
        width: 'resolve',
        theme: "classic",
        dropdownParent: $('#addModal')
    });
    $('#select3').select2({
        width: 'resolve',
        theme: "classic",
        dropdownParent: $('#addModal')
    });

    $('.select').select2({
      width: 'resolve',
      theme: "classic",
      dropdownParent: $('#addModal'),
      createTag: function (params) {
        var term = $.trim(params.term);

        if (term === '') {
          return null;
        }

        return {
          id: term,
          text: term,
          newTag: true // add additional parameters
        }
      }
    })

    $('#selects1').select2({
        width: 'resolve',
        theme: "classic",
        // dropdownParent: $('#addModal')
    });
    $('#selects2').select2({
        width: 'resolve',
        theme: "classic",
        // dropdownParent: $('#addModal')
    });
    $('#selects3').select2({
        width: 'resolve',
        theme: "classic",
        // dropdownParent: $('#addModal')
    });
    $('.selects').select2({
      width: 'resolve',
      theme: "classic",
    //   dropdownParent: $('#newRevenue'),
      createTag: function (params) {
        var term = $.trim(params.term);

        if (term === '') {
          return null;
        }

        return {
          id: term,
          text: term,
          newTag: true ,
          // add additional parameters
        }
      }
    })

    $('.selectu').select2({
      width: 'resolve',
      theme: "classic",
      dropdownParent: $('#updateModal'),
      createTag: function (params) {
        var term = $.trim(params.term);

        if (term === '') {
          return null;
        }

        return {
          id: term,
          text: term,
          newTag: true ,
          // add additional parameters
        }
      }
    })

    // $('.select2').select2({
    //   createTag: function (params) {
    //     width: 'resolve',
    //     theme: "classic",
    //     var term = $.trim(params.term);

    //     if (term === '') {
    //       return null;
    //     }

    //     return {
    //       id: term,
    //       text: term,
    //       newTag: true
    //       // add additional parameters
    //     }
    //   }
    // });

    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}"
    switch (type) {
      case 'info':
        toastr.info(" {{ Session::get('message') }} ");
        break;

      case 'success':
        toastr.success(" {{ Session::get('message') }} ");
        break;

      case 'warning':
        toastr.warning(" {{ Session::get('message') }} ");
        break;

      case 'error':
        toastr.error(" {{ Session::get('message') }} ");
        break;
    }
    @endif



    $(document).ready( function () {
        $('#datatable11').DataTable({
            pageLength: 100,
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print'
            ],
        });
    } );
  </script>
  <!-- End toaster js -->

  <!-- idle timeout -->
  <script type="text/javascript">
    // $(document).ready(function($) {

      // function start_timer() {  }

    //   $.jq_easy_session_timeout({
    //     inactivityDialogDuration: 125,
    //     maxInactivitySeconds: 250,
    //     inactivityLogoutUrl: function() {
    //       //log user off
    //       $.ajax({
    //         url: "{{ route('logout') }}",
    //         method: 'POST',
    //         data: {
    //           _token: '{{ csrf_token() }}'
    //         },
    //         success: function() {
    //           // redirect to Laravel login page
    //           window.location.href = "{{ route('login') }}";
    //         }
    //       });
    //     },
    //   });


    //   $(document).on('click', '.btn_start_timer', function(event) {
    //     event.preventDefault();
    //     start_timer();
    //   });

    // });

    // $(document).ready(function() {
    //   $('.select2').select2({
    //     theme: "classic"
    //   });

    // })
  </script>
  <!-- idle timeout ends -->



</body>

</html>
