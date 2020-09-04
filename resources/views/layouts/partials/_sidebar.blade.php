<!-- Sidebar content -->
<div class="sidebar-content">

     {{-- <!-- User menu -->
     <div class="sidebar-user-material">
          <div class="sidebar-user-material-body card-img-top">
               <div class="card-body text-center">
                    <a href="#">
                         <img src="/global_assets/images/placeholders/placeholder.jpg"
                              class="img-fluid rounded-circle shadow-2 mb-3" width="80" height="80" alt="">
                    </a>
                    <h6 class="mb-0 text-white text-shadow-dark">Victoria Baker</h6>
                    <span class="font-size-sm text-white text-shadow-dark">Santa Ana, CA</span>
               </div>

               <div class="sidebar-user-material-footer">
                    <a href="#user-nav"
                         class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle"
                         data-toggle="collapse"><span>My account</span></a>
               </div>
          </div>

          <div class="collapse" id="user-nav">
               <ul class="nav nav-sidebar">
                    <li class="nav-item">
                         <a href="#" class="nav-link">
                              <i class="icon-user-plus"></i>
                              <span>My profile</span>
                         </a>
                    </li>
                    <li class="nav-item">
                         <a href="#" class="nav-link">
                              <i class="icon-coins"></i>
                              <span>My balance</span>
                         </a>
                    </li>
                    <li class="nav-item">
                         <a href="#" class="nav-link">
                              <i class="icon-comment-discussion"></i>
                              <span>Messages</span>
                              <span class="badge bg-success-400 badge-pill align-self-center ml-auto">58</span>
                         </a>
                    </li>
                    <li class="nav-item">
                         <a href="#" class="nav-link">
                              <i class="icon-cog5"></i>
                              <span>Account settings</span>
                         </a>
                    </li>
                    <li class="nav-item">
                         <a href="#" class="nav-link">
                              <i class="icon-switch2"></i>
                              <span>Logout</span>
                         </a>
                    </li>
               </ul>
          </div>
     </div>
     <!-- /user menu --> --}}


     <!-- Navigation -->
     <div class="card card-sidebar-mobile ">

          <div class="card-body p-0">
               <ul class="nav nav-sidebar" data-nav-type="accordion">
                    <li class="nav-item">
                         <a href="{{ route('dashboard') }}" class="nav-link active">
                              <i class="fas fa-home"></i>
                              <span>
                                   Dashboard
                              </span>
                         </a>
                    </li>
                    @role('superadmin')
                    <li class="nav-item">
                         <a href="/superadmin/admin" class="nav-link">
                              <i class="fas fa-user-tie"></i>
                              <span>
                                   Admin
                              </span>
                         </a>
                    </li>
                    <li class="nav-item">
                         <a href="{{ route('admin.partner.index') }}" class="nav-link">
                              <i class="fas fa-people-carry"></i>
                              <span>
                                   Mitra
                              </span>
                         </a>
                    </li>
                    <li class="nav-item">
                         <a href="{{ route('admin.employee.index') }}" class="nav-link">
                              <i class="fas fa-user-injured"></i>
                              <span>
                                   Pegawai
                              </span>
                         </a>
                    </li>
                    <li class="nav-item nav-item-submenu">
                         <a href="#" class="nav-link"><i class="fas fa-box"></i> <span>Produk</span></a>

                         <ul class="nav nav-group-sub" data-submenu-title="Product">
                              <li class="nav-item"><a href="{{ route('admin.product.grain.index') }}" class="nav-link">Gabah</a>
                              </li>
                              <li class="nav-item"><a href="{{ route('admin.product.rice.index') }}" class="nav-link">Beras</a>
                              </li>
                              <li class="nav-item"><a href="{{ route('admin.product.bran.index') }}" class="nav-link">Dedak</a>
                              </li>
                              <li class="nav-item"><a href="{{ route('admin.product.menir.index') }}" class="nav-link">Menir</a>
                              </li>
                              <li class="nav-item"><a href="{{ route('admin.product.broken.index') }}" class="nav-link">Broken</a>
                              </li>
                         </ul>
                    </li>
                    <li class="nav-item nav-item-submenu">
                         <a href="#" class="nav-link"><i class="fas fa-comment-dollar"></i> <span>Transaksi</span></a>

                         <ul class="nav nav-group-sub" data-submenu-title="Transaksi">
                              <li class="nav-item"><a href="{{ route('admin.product.grain.index') }}" class="nav-link">Pembelian gabah</a>
                              </li>
                              <li class="nav-item nav-item-submenu">
                                   <a href="#" class="nav-link"> <span>Penjualan</span></a>
                                   <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                        <li class="nav-item"><a href="{{ route('admin.product.rice.index') }}" class="nav-link">Penjualan Beras</a>
                                        </li>
                                        <li class="nav-item"><a href="{{ route('admin.product.rice.index') }}" class="nav-link">Penjualan Beras Eceran</a>
                                        </li>
                                        <li class="nav-item"><a href="{{ route('admin.product.rice.index') }}" class="nav-link">Penjualan Dedak</a>
                                        </li>
                                        <li class="nav-item"><a href="{{ route('admin.product.rice.index') }}" class="nav-link">Penjualan menir</a>
                                        </li>
                                        <li class="nav-item"><a href="{{ route('admin.product.rice.index') }}" class="nav-link">Penjualan Broken</a>
                                        </li>
                                   </ul>
                              </li>
                              <li class="nav-item"><a href="{{ route('admin.product.rice.index') }}" class="nav-link">Utang</a>
                              </li>
                              <li class="nav-item"><a href="{{ route('admin.product.bran.index') }}" class="nav-link">Piutang</a>
                              </li>
                         </ul>
                    </li>
                    <li class="nav-item nav-item-submenu">
                         <a href="#" class="nav-link"><i class="fas fa-industry"></i><span>Produksi</span></a>

                         <ul class="nav nav-group-sub" data-submenu-title="Produksi">
                              <li class="nav-item"><a href="{{ route('admin.product.grain.index') }}" class="nav-link">Pengeringan</a>
                              </li>
                              <li class="nav-item"><a href="{{ route('admin.product.rice.index') }}" class="nav-link">Penggilingan</a>
                              </li>
                         </ul>
                    </li>
                    <li class="nav-item nav-item-submenu">
                         <a href="#" class="nav-link"><i class="fas fa-book"></i> <span>Laporan</span></a>

                         <ul class="nav nav-group-sub" data-submenu-title="Laporan">
                              <li class="nav-item"><a href="{{ route('admin.product.grain.index') }}" class="nav-link">Laporan Pembelian</a>
                              </li>
                              <li class="nav-item"><a href="{{ route('admin.product.rice.index') }}" class="nav-link">Laporan Penjualan</a>
                              </li>
                              <li class="nav-item"><a href="{{ route('admin.product.rice.index') }}" class="nav-link">Laporan Beban</a>
                              </li>
                              <li class="nav-item"><a href="{{ route('admin.product.rice.index') }}" class="nav-link">Laporan Rugi Laba</a>
                              </li>
                         </ul>
                    </li>
                    @endrole

                    @role('admin')

                    @endrole
               </ul>
          </div>
     </div>
     <!-- /navigation -->

</div>
<!-- /sidebar content -->
