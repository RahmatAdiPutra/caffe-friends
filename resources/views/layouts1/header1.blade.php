<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Caffe Friends</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    	@if (Auth::check())
          @can ('Position.*')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/position') }}">Position</a>
          </li>
          @endcan
          @can ('Employee.*')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/employee') }}">Employee</a>
          </li>
          @endcan
          @can ('Member.*')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/member') }}">Member</a>
          </li>
          @endcan
          @can ('Item.*')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/item') }}">Item</a>
          </li>
          @endcan
          @can ('DetailItem.*')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/detailItem') }}">Detail Item</a>
          </li>
          @endcan
          @can ('Order.*')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/order') }}">Order</a>
          </li>
          @endcan
          @can ('DetailOrder.*')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/detailOrder') }}">Detail Order</a>
          </li>
          @endcan
          @can ('ApprovOrder.*')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/approvOrder') }}">Approv Order</a>
          </li>
          @endcan
          @can ('Payout.*')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/payout') }}">Payout</a>
          </li>
          @endcan
          @can ('Role.*')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/role') }}">Role</a>
          </li>
          @endcan
          @can ('Permission.*')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/permission') }}">Permission</a>
          </li>
          @endcan
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->name }} <span class="caret"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('employee.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('employee.logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link" href="{{ route('employee.login') }}">{{ __('Login') }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('employee.register') }}">{{ __('Register') }}</a>
          </li>
        @endif
    </ul>
  </div>
</nav>