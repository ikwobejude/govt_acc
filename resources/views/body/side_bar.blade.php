<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="/" class="app-brand-link">
        <span class="app-brand-logo demo">
            <img src="{{ asset('download.png') }}" alt="" style="height: 50px">
        </span>
        {{-- <span class="app-brand-text demo menu-text fw-bold ms-2">Sneat</span> --}}
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboards -->


      <li class="menu-item {{ url()->current() == route('dashboard') ? 'active open' : ''}}">
        <a href="/dashboard" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Boxicons" class="{{ url()->current() == route('dashboard') ? 'active' : ''}}">Dashboards</div>
        </a>
      </li>

      <!-- Layouts -->
      {{-- <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-layout"></i>
          <div data-i18n="Layouts">Layouts</div>
        </a>

        <ul class="menu-sub">
          <li class="menu-item">
            <a href="layouts-without-menu.html" class="menu-link">
              <div data-i18n="Without menu">Without menu</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="layouts-without-navbar.html" class="menu-link">
              <div data-i18n="Without navbar">Without navbar</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="layouts-container.html" class="menu-link">
              <div data-i18n="Container">Container</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="layouts-fluid.html" class="menu-link">
              <div data-i18n="Fluid">Fluid</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="layouts-blank.html" class="menu-link">
              <div data-i18n="Blank">Blank</div>
            </a>
          </li>
        </ul>
      </li> --}}
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Settings</span>
      </li>
      <li class="menu-item {{ url()->current() == route('get.revenue_line') ? 'active open' : ''}}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-dock-top"></i>
          <div data-i18n="Account Settings">Revenue Setup</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{url()->current() == route('get.revenue_line') ? 'active open' : ''}}">
            <a href="{{ route('get.revenue_line') }}" class="menu-link">
              <div data-i18n="Account">Revenue</div>
            </a>
          </li>
        </ul>
      </li>
      <li class="menu-item {{url()->current() == route('post.expenditure_batch_name') ? 'active open' : ''}}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
          <div data-i18n="Authentications">Expenditure Setup</div>
        </a>
        <ul class="menu-sub">
          {{-- <li class="menu-item">
            <a href="{{ route('expenditure_type') }}" class="menu-link" target="_blank">
              <div data-i18n="Basic">Expenditure Type</div>
            </a>
          </li> --}}
          <li class="menu-item {{url()->current() == route('post.expenditure_batch_name') ? 'active' : ''}}">
            <a href="{{ route('post.expenditure_batch_name') }}" class="menu-link">
              <div data-i18n="Basic">Expenditure Batch Name</div>
            </a>
          </li>
          {{-- <li class="menu-item">
            <a href="auth-forgot-password-basic.html" class="menu-link" target="_blank">
              <div data-i18n="Basic">Forgot Password</div>
            </a>
          </li> --}}
        </ul>
      </li>
      <li class="menu-item {{
        (url()->current() == route('asset.type') ? 'active open' :
        (url()->current() == route('asset.size') ? 'active open' :
        (url()->current() == route('asset.categories') ? 'active open' :
        (url()->current() == route('asset.location.post') ? 'active open' :''))))
        }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-cube-alt"></i>
          <div data-i18n="Fixed Assets Register">Assets SetUp </div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{url()->current() == route('asset.type') ? 'active' : ''}}">
            <a href="{{ route('asset.type') }}" class="menu-link">
              <div data-i18n="Depreciation Rate">Asset Type</div>
            </a>
          </li>
          <li class="menu-item {{url()->current() == route('asset.size') ? 'active' : ''}}">
            <a href="{{ route('asset.size') }}" class="menu-link">
              <div data-i18n="Asset Register">Asset Size</div>
            </a>
          </li>
          <li class="menu-item {{url()->current() == route('asset.categories') ? 'active' : ''}}">
            <a href="{{ route('asset.categories') }}" class="menu-link">
              <div data-i18n="Asset Register">Asset Category</div>
            </a>
          </li>
          <li class="menu-item {{url()->current() == route('asset.location.post') ? 'active' : ''}}">
            <a href="{{ route('asset.location.post') }}" class="menu-link">
              <div data-i18n="Asset Register">Asset Location</div>
            </a>
          </li>
        </ul>
      </li>

      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Chart of Accounts</span>
      </li>
      <!-- Apps -->


      <!-- Pages -->
      <li class="menu-item {{
        (url()->current() == route('get.revenue') ? 'active open' :
        (url()->current() == route('get.expenditure') ? 'active open' :
        (url()->current() == route('get.asset') ? 'active open' :
        (url()->current() == route('get.liabilities') ? 'active open' :''))))
        }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-dock-top"></i>
          <div data-i18n="Account Settings">Chart of Accounts</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ url()->current() == route('get.revenue') ? 'active' : ''}}">
            <a href="{{ route('get.revenue') }}" class="menu-link">
              <div data-i18n="Account">Revenue</div>
            </a>
          </li>
          <li class="menu-item {{ url()->current() == route('get.expenditure') ? 'active' : ''}}">
            <a href="{{ route('get.expenditure') }}" class="menu-link">
              <div data-i18n="Notifications" >Expenditure</div>
            </a>
          </li>
          <li class="menu-item {{ url()->current() == route('get.asset') ? 'active' : ''}}">
            <a href="{{ route('get.asset') }}" class="menu-link">
              <div data-i18n="Connections">Assets</div>
            </a>
          </li>
          <li class="menu-item {{ url()->current() == route('get.liabilities') ? 'active' : ''}}">
            <a href="{{ route('get.liabilities') }}" class="menu-link">
              <div data-i18n="Connections">Liability</div>
            </a>
          </li>
        </ul>
      </li>
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
          <div data-i18n="Authentications">Budget Management</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="#" class="menu-link" target="_blank">
              <div data-i18n="Basic">Budgeting</div>
            </a>
          </li>
          {{-- <li class="menu-item">
            <a href="auth-register-basic.html" class="menu-link" target="_blank">
              <div data-i18n="Basic">Register</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="auth-forgot-password-basic.html" class="menu-link" target="_blank">
              <div data-i18n="Basic">Forgot Password</div>
            </a>
          </li> --}}
        </ul>
      </li>
      <li class="menu-item {{
        (url()->current() == route('get.ppeclass') ? 'active open' :
        (url()->current() == route('get.ppe') ? 'active open' : ''))
        }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-cube-alt"></i>
          <div data-i18n="Fixed Assets Register">Fixed Assets Register</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ url()->current() == route('get.ppeclass') ? 'active' : ''}}">
            <a href="{{ route('get.ppeclass')}}" class="menu-link">
                <div data-i18n="Depreciation Rate">PPE clasee</div>
            </a>
          </li>
          {{-- <li class="menu-item">
            <a href="#" class="menu-link">
              <div data-i18n="Depreciation Rate">Depreciation Rate</div>
            </a>
          </li> --}}
          <li class="menu-item {{ url()->current() == route('get.ppe') ? 'active' : ''}}">
            <a href="{{ route('get.ppe') }}" class="menu-link">
              <div data-i18n="Asset Register">Asset Register</div>
            </a>
          </li>
        </ul>

      </li>

      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
          <div data-i18n="Invoicing">Invoicing</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="#" class="menu-link" target="_blank">
              <div data-i18n="Basic">Vendor Management</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link" target="_blank">
              <div data-i18n="Basic">Invoice Management</div>
            </a>
          </li>
        </ul>
      </li>
      <!-- Components -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Transactions</span></li>
      <!-- Cards -->

      <!-- User interface -->
      <li class="menu-item {{ url()->current() == route('expenditure') ? 'active' : ''}}">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-box"></i>
          <div data-i18n="Revenue Receipts">Revenue Receipts</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="#" class="menu-link">
              <div data-i18n="Revenue Receipts">Revenue Receipts</div>
            </a>
          </li>
          <li class="menu-item {{ url()->current() == route('expenditure') ? 'active' : ''}}">
            <a href="{{ route('expenditure') }}" class="menu-link">
              <div data-i18n="Payment Voucher">Payment Voucher</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link">
              <div data-i18n="Journal Voucher">Journal Voucher</div>
            </a>
          </li>

        </ul>
      </li>

      <!-- Extended components -->
      {{-- <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-copy"></i>
          <div data-i18n="Invoicing">Invoicing</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="#" class="menu-link">
              <div data-i18n="Vendor Management">Vendor Management</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link">
              <div data-i18n="Invoice Management">Invoice Management</div>
            </a>
          </li>
        </ul>
      </li> --}}

      {{-- <li class="menu-item">
        <a href="icons-boxicons.html" class="menu-link">
          <i class="menu-icon tf-icons bx bx-crown"></i>
          <div data-i18n="Boxicons">Boxicons</div>
        </a>
      </li> --}}

      <!-- Forms & Tables -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Approvals</span></li>
      <!-- Forms -->
      <li class="menu-item {{
       (url()->current() == route('view.approve.revenue') ? 'active open' :
       (url()->current() == route('view.approve.expenditure') ? 'active open' :
       (url()->current() == route('view.approve.asset') ? 'active open' : '')))
       }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-detail"></i>
          <div data-i18n="Approvals">Approvals</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ url()->current() == route('view.approve.revenue') ? 'active' : ''}}">
            <a href="{{ route('view.approve.revenue') }}" class="menu-link">
              <div data-i18n="Chart of Accounts">Revenue</div>
            </a>
          </li>
          <li class="menu-item {{ url()->current() == route('view.approve.expenditure') ? 'active' : ''}}">
            <a href="{{ route('view.approve.expenditure') }}" class="menu-link">
              <div data-i18n="Chart of Accounts">Expenditure</div>
            </a>
          </li>

          <li class="menu-item {{ url()->current() == route('view.approve.asset') ? 'active' : ''}}">
            <a href="{{ route('view.approve.asset') }}" class="menu-link">
              <div data-i18n="Chart of Accounts">Asset</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link">
              <div data-i18n="Budgets">Budgets</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link">
              <div data-i18n="Fixed Assets Register">Fixed Assets Register</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link">
              <div data-i18n="Vendors">Vendors</div>
            </a>
          </li>

          <li class="menu-item">
            <a href="#" class="menu-link">
              <div data-i18n="Journal Vouchers">Journal Vouchers</div>
            </a>
          </li>
        </ul>
      </li>

      <li class="menu-header small text-uppercase"><span class="menu-header-text">Final Accounts</span></li>
      <li class="menu-item {{
        (url()->current() == route('view.account_payable') ? 'active open' :
        (url()->current() == route('view.account_receivable') ? 'active open' :''))
        }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-detail"></i>
          <div data-i18n="Final Accounts">General Ledger</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ url()->current() == route('view.account_payable') ? 'active' : ''}}">
            <a href="{{ route('view.account_payable') }}" class="menu-link">
              <div data-i18n="Vertical Form">Accounts Payables</div>
            </a>
          </li>
          <li class="menu-item {{ url()->current() == route('view.account_receivable') ? 'active' : ''}}">
            <a href="{{ route('view.account_receivable') }}" class="menu-link">
              <div data-i18n="Horizontal Form">Accounts Receivables</div>
            </a>
          </li>

        </ul>
      </li>
      <li class="menu-item {{ url()->current() == route('view.trial_balcance') ? 'active' : ''}}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-detail"></i>
          <div data-i18n="Final Accounts">Trial Balance</div>
        </a>
        <ul class="menu-sub">

          <li class="menu-item {{ url()->current() == route('view.trial_balcance') ? 'active' : ''}}">
            <a href="{{ route('view.trial_balcance') }}" class="menu-link">
              <div data-i18n="Horizontal Form">Trial Balance</div>
            </a>
          </li>



        </ul>
      </li>



      <!-- Misc -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li>
      <li class="menu-item">
        <a
          href="#"
          target="_blank"
          class="menu-link">
          <i class="menu-icon tf-icons bx bx-support"></i>
          <div data-i18n="Support">Support</div>
        </a>
      </li>
      <li class="menu-item">
        <a
          href="#"
          target="_blank"
          class="menu-link">
          <i class="menu-icon tf-icons bx bx-file"></i>
          <div data-i18n="Documentation">Documentation</div>
        </a>
      </li>
    </ul>
  </aside>
