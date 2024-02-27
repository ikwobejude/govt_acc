<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />



    <link rel="stylesheet" href="{{ asset('back/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('back/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('back/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('back/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('back/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('back/assets/vendor/css/pages/page-auth.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('back/assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('back/assets/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">

                    <img src="{{asset('logo.png')}}" alt="" style="height: 100px">
                  </span>
                  <span class="app-brand-text text-body fw-bold">Reset Password</span>
                </a>
              </div>
              <!-- /Logo -->
              {{-- <h4 class="mb-2">Welcome! 👋</h4> --}}
              <x-auth-session-status class="mb-4" :status="session('status')" />

              <form id="formAuthentication" class="mb-3"  method="POST" action="{{ route('post.user_reset_password') }}">
                @csrf
                    <div class="mb-3">
                      <label for="username" class="form-label">Old password</label>
                      <input
                        type="password"
                        class="form-control  @error('old_password') is-invalid @enderror"
                        id="old_password"
                        name="old_password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"/>
                        @error('old_password')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                      <label for="email" class="form-label">New Password</label>
                      <div class="input-group input-group-merge">
                      <input
                        type="password"
                        class="form-control @error('old_password') is-invalid @enderror"
                        id="password"
                        name="password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password"/>
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                      </div>
                      @error('password')
                            <span class="text-danger"> {{ $message }} </span>
                      @enderror
                    </div>
                    <div class="mb-3 form-password-toggle">
                      <label class="form-label" for="password">Password</label>
                      <div class="input-group input-group-merge">
                        <input
                          type="password"
                          id="password"
                          class="form-control @error('confirm_password') is-invalid @enderror"
                          name="confirm_password"
                          placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                          aria-describedby="password" />
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                      </div>
                      @error('confirm_password')
                        <span class="text-danger"> {{ $message }} </span>
                      @enderror
                    </div>


                    <button type="submit" class="btn btn-primary d-grid w-100">Submit</button>

              </form>

              <p class="text-center">
                <span>New on our platform?</span>
                <a href="{{ route('register') }}">
                  <span>Create an account</span>
                </a>
              </p>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->



    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="{{ asset('back/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('back/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('back/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('back/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('back/assets/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('back/assets/js/main.js') }}"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
        switch (type) {
            case 'info':
                toastr.info(" {{ Session::get('message') }} ");
                break;

            case 'success':
                toastr.success(" {{ Session::get('message') }} ").then(() => {
                    location.assign('/login')
                });
                break;

            case 'warning':
                toastr.warning(" {{ Session::get('message') }} ");
                break;

            case 'error':
                toastr.error(" {{ Session::get('message') }} ");
                break;
        }
        @endif
    </script>
  </body>
</html>
