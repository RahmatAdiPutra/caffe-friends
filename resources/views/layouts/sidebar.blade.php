<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          {{-- <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> --}}
        </div>
        <div class="pull-left info">
          <p>{{-- {{ Auth::user()->name }} --}}</p>
        </div>
      </div>
      <!-- search form -->
      {{-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> --}}
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENU</li>
        <li class="active treeview">
          @if (Auth::check())
            @can ('Position.*')
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/position') }}"><i class="fa fa-circle-o"></i> Position</a>
            </li>
            @endcan
            @can ('Employee.*')
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/employee') }}"><i class="fa fa-circle-o"></i> Employee</a>
            </li>
            @endcan
            @can ('Member.*')
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/member') }}"><i class="fa fa-circle-o"></i> Member</a>
            </li>
            @endcan
            @can ('Item.*')
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/item') }}"><i class="fa fa-circle-o"></i> Item</a>
            </li>
            @endcan
            @can ('DetailItem.*')
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/detailItem') }}"><i class="fa fa-circle-o"></i> Detail Item</a>
            </li>
            @endcan
            @can ('Order.*')
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/order') }}"><i class="fa fa-circle-o"></i> Order</a>
            </li>
            @endcan
            @can ('DetailOrder.*')
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/detailOrder') }}"><i class="fa fa-circle-o"></i> Detail Order</a>
            </li>
            @endcan
            @can ('ApprovOrder.*')
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/approvOrder') }}"><i class="fa fa-circle-o"></i> Approv Order</a>
            </li>
            @endcan
            @can ('Payout.*')
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/payout') }}"><i class="fa fa-circle-o"></i> Payout</a>
            </li>
            @endcan
            @can ('Role.*')
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/role') }}"><i class="fa fa-circle-o"></i> Role</a>
            </li>
            @endcan
            @can ('Permission.*')
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/permission') }}"><i class="fa fa-circle-o"></i> Permission</a>
            </li>
            @endcan
          @endif
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>