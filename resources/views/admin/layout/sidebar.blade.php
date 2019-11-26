  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('assets/admin-lte') }}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->nama }}</p>
            <a href="#">Status : <i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Data Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('barang.index') }}"><i class="fa fa-circle-o"></i> Data Barang</a></li>
            <li><a href="{{ route('kategori.index') }}"><i class="fa fa-circle-o"></i> Data Kategori</a></li>
            <li><a href="{{ route('satuan.index') }}"><i class="fa fa-circle-o"></i> Data Satuan</a></li>
            <li><a href="{{ route('supplier.index') }}"><i class="fa fa-circle-o"></i> Data Supplier</a></li>
            <li><a href="{{ route('pelanggan.index') }}"><i class="fa fa-circle-o"></i> Data Pelanggan</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Penjualan
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('penjualan.create') }}"><i class="fa fa-circle-o"></i> Transaksi Penjualan</a></li>
                <li><a href="{{ route('penjualan.index') }}"><i class="fa fa-circle-o"></i> Data Penjualan</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Stok Masuk
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('stokmasuk.create') }}"><i class="fa fa-circle-o"></i> Transaksi Stok Masuk</a></li>
                <li><a href="{{ route('stokmasuk.index') }}"><i class="fa fa-circle-o"></i> Data Stok Masuk</a></li>
              </ul>
            </li>
             <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Stok Keluar
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('stokkeluar.create') }}"><i class="fa fa-circle-o"></i> Transaksi Stok Keluar</a></li>
                <li><a href="{{ route('stokkeluar.index') }}"><i class="fa fa-circle-o"></i> Data Stok Keluar</a></li>
              </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Stom Opname</a></li>
          </ul>
        </li>
        <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->
