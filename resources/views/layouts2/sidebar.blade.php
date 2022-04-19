<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

  
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          

               <?php
               $pemasukan_rutin= DB::table('pemasukan_rutin');
               $pemasukan_khusus= DB::table('pemasukan_khusus');
               $pengeluaran_khusus= DB::table('pengeluaran_khusus');
               $pengeluaran_rutin= DB::table('pengeluaran_rutin');
               ?>

 
                <li class="nav-item {{ setActive(['home*']) }}"> 
                  <a class="nav-link {{ setActive(['home*']) }}" href="{{route('home')}}">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                        Grafik
                      
                      </p>
                    </a>
                </li>


                @if(Auth::user()->petugas)       
                <div class="user-panel mt-1 pb-1 mb-1 d-flex">     
                </div>
                <!-- <li class=""> 
                  <a class="nav-link" >
                      
                      <p>
                        pemasukan_rutin
                      </p>
                    </a>
                </li>     -->
                
                
                <li class="nav-item {{ setActive(['donasi*']) }}"> 
                  <a class="nav-link {{ setActive(['donasi*']) }}" href="/donasi">
                      <i class="nav-icon fas fa-cloud"></i>
                      <p>
                        Midtrans
                      </p>
                    </a>
                </li>
      
                @if(Auth::user()->petugas)
                        <li li class="nav-item">
                          <a class="nav-link " data-toggle="collapse" href="#ui-basicTM" aria-controls="ui-basic">
                            <i class="nav-icon fas fa-caret-up"></i>
                            <p>
                              Pemasukan  
                                              
                              <i class="right fas fa-angle-left"></i>
                              </p>
                                            <span class="badge bg-danger">
                                              @if(Auth::user()->level == 'admin')
                                                {{
                                                  $pemasukan_rutin->where('status', '0')
                                                  ->count()
                                                  +
                                                  $pemasukan_khusus->where('status', '0')
                                                  ->count()
                                                }}
                                              @else
                                              {{
                                                  $pemasukan_rutin->where('status', '0')
                                                  ->where('nama_pengguna', Auth::user()->petugas->id)
                                                  ->count()
                                                  +
                                                  $pemasukan_khusus->where('status', '0')
                                                  ->where('nama_pengguna', Auth::user()->petugas->id)
                                                  ->count()
                                                }}
                                              @endif
                                            </span> 
                          </a>

                          <div class="collapse {{ setShow(['pemasukan_rutin*','pemasukan_khusus*']) }}" id="ui-basicTM">
                            <ul class="nav flex-column sub-menu">
                              
                          
                              @if(Auth::user()->level == 'admin')
                                <li class="nav-item">
                                  <a class="nav-link {{ setActive(['pemasukan_rutin*']) }}" href="{{route('pemasukan_rutin.index')}}">
                                  <i class="far fa-circle nav-icon"></i>
                                    <p>Rutin</p>     
                                    <span class="badge bg-danger">
                                      {{
                                        $pemasukan_rutin->where('status', '0')
                                        ->count()
                                      }}
                                    </span> 
                                  </a>
                                </li>
                                @else
                                    @if(Auth::user()->petugas)
                                        <li class="nav-item">
                                          <a class="nav-link {{ setActive(['pemasukan_rutin*']) }}" href="{{route('pemasukan_rutin.index')}}">
                                          <i class="far fa-circle nav-icon"></i>
                                            <p>Rutin</p>
                                                    
                                                      <span class="badge bg-danger">
                                                        {{
                                                          $pemasukan_rutin->where('status', '0')
                                                          ->where('nama_pengguna', Auth::user()->petugas->id)
                                                          ->count()
                                                        }}
                                                      </span>
                                                
                                          </a>
                                        </li>
                                    @endif

                              @endif

                              <!--kas-->
                              @if(Auth::user()->level == 'admin')
                                <li class="nav-item">
                                  <a class="nav-link {{ setActive(['pemasukan_khusus*']) }}" href="{{route('pemasukan_khusus.index')}}">
                                <i class="far fa-circle nav-icon"></i>
                                  <p>Khusus</p>
                                  
                                            <span class="badge bg-danger">
                                              {{
                                                $pemasukan_khusus->where('status', '0')
                                                ->count()
                                              }}
                                            </span> 
                                  </a>
                                </li>
                                @else
                                    @if(Auth::user()->petugas)
                                        <li class="nav-item">
                                          <a class="nav-link {{ setActive(['pemasukan_khusus*']) }}" href="{{route('pemasukan_khusus.index')}}">
                                        <i class="far fa-circle nav-icon"></i>
                                          <p>Khusus</p>
                                                    @if(Auth::user()->petugas)
                                                    <span class="badge bg-danger">
                                                      {{
                                                        $pemasukan_khusus->where('status', '0')
                                                        ->where('nama_pengguna', Auth::user()->petugas->id)
                                                        ->count()
                                                      }}
                                                    </span>
                                                    @endif
                                          </a>
                                        </li>
                                    @endif
                              @endif

                            </ul>
                          </div>
                        </li>
                      @endif
                <!-- TUTUP -->
                

                      @if(Auth::user()->petugas)
                        <li li class="nav-item">
                          <a class="nav-link " data-toggle="collapse" href="#ui-basic1" aria-controls="ui-basic">
                            <i class="nav-icon fas fa-caret-down"></i>
                            <p>
                              Pengeluaran  
                                              
                              <i class="right fas fa-angle-left"></i>
                            </p>
                            <span class="badge bg-danger">
                                              @if(Auth::user()->level == 'admin')
                                                {{
                                                  $pengeluaran_rutin->where('status', '0')
                                                  ->count()
                                                  +
                                                  $pengeluaran_khusus->where('status', '0')
                                                  ->count()
                                                }}
                                              @else
                                              {{
                                                  $pengeluaran_rutin->where('status', '0')
                                                  ->where('nama_pengguna', Auth::user()->petugas->id)
                                                  ->count()
                                                  +
                                                  $pengeluaran_khusus->where('status', '0')
                                                  ->where('nama_pengguna', Auth::user()->petugas->id)
                                                  ->count()
                                                }}
                                              @endif

                                            </span> 
                          </a>

                          <div class="collapse {{ setShow(['pengeluaran_rutin*','pengeluaran_khusus*']) }}" id="ui-basic1">
                            <ul class="nav flex-column sub-menu">
                              
                          
                              @if(Auth::user()->level == 'admin')
                                <li class="nav-item">
                                  <a class="nav-link {{ setActive(['pengeluaran_rutin*']) }}" href="{{route('pengeluaran_rutin.index')}}">
                                <i class="far fa-circle nav-icon"></i>
                                  <p>Rutin</p>
                                  
                                            <span class="badge bg-danger">
                                              {{
                                                $pengeluaran_rutin->where('status', '0')
                                                ->count()
                                              }}
                                            </span> 
                                  </a>
                                </li>

                              @endif

                              <!--kas-->
                              @if(Auth::user()->level == 'admin')
                                <li class="nav-item">
                                  <a class="nav-link {{ setActive(['pengeluaran_khusus*']) }}" href="{{route('pengeluaran_khusus.index')}}">
                                <i class="far fa-circle nav-icon"></i>
                                  <p>Khusus</p>
                                  
                                            <span class="badge bg-danger">
                                              {{
                                                $pengeluaran_khusus->where('status', '0')
                                                ->count()
                                              }}
                                            </span> 
                                  </a>
                                </li>
                                @else
                                    @if(Auth::user()->petugas)
                                        <li class="nav-item">
                                          <a class="nav-link {{ setActive(['pengeluaran_khusus*']) }}" href="{{route('pengeluaran_khusus.index')}}">
                                        <i class="far fa-circle nav-icon"></i>
                                          <p>Khusus</p>
                                                    @if(Auth::user()->petugas)
                                                    <span class="badge bg-danger">
                                                      {{
                                                        $pengeluaran_khusus->where('status', '0')
                                                        ->where('nama_pengguna', Auth::user()->petugas->id)
                                                        ->count()
                                                      }}
                                                    </span>
                                                    @endif
                                          </a>
                                        </li>
                                    @endif
                              @endif

                            </ul>
                          </div>
                        </li>
                      @endif

              
                  <div class="user-panel mt-1 pb-1 mb-1 d-flex">     
                </div>
                @endif
              
    
              <!-- MASTER DATA -->
           

              @if(Auth::user()->level == 'admin')
                <li li class="nav-item">
                <a class="nav-link " data-toggle="collapse" href="#ui-basic" aria-controls="ui-basic">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                      Master Data
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>

                  <div class="collapse {{ setShow(['petugas*','detail_kategori*','kas*', 'user*','ibadah*','kategori*', 'detail_pengeluaran*']) }}" id="ui-basic">
                    <ul class="nav flex-column sub-menu">


                    <li class="nav-item">
                      <a class="nav-link {{ setActive(['user*']) }}" href="{{route('user.index')}}">
                        <i class="far fa-user-circle nav-icon"></i>
                        <p>Akun</p>
                        </a>
                      </li>
                      
                    <li class="nav-item">
                        <a class="nav-link {{ setActive(['petugas*']) }}" href="{{route('petugas.index')}}">
                        <i class="far fa-hand-rock nav-icon"></i>
                        <p>Petugas</p>
                        </a>
                      </li>
                      @if(Auth::user()->petugas)
                        <li class="nav-item">
                          
                          <a class="nav-link {{ setActive(['ibadah*']) }}" href="{{route('ibadah.index')}}">
                          <i class="far fa fa-table nav-icon"></i>
                          <p>Ibadah</p>
                          </a >
                        </li>      

                          <!-- <li li class="nav-item">
                            <a class="nav-link " data-toggle="collapse" href="#ui-basic2" aria-controls="ui-basic">
                            <i class="nav-icon fas fa-archive"></i>
                              <p>
                                Kategori Pemasukan  
                                <i class="right fas fa-angle-left"></i>
                              </p>
                            </a>

                            <div class="collapse {{ setShow(['kategori*','detail_kategori*']) }}" id="ui-basic2">
                              <ul class="nav flex-column sub-menu">
                                
                            
                        
                                  <li class="nav-item">
                                  <a class="nav-link {{ setActive(['kategori*']) }}" href="{{route('kategori.index')}}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Kategori</p>
                                  </a>
                                  </li>
  
                                  <li class="nav-item">
                                  <a class="nav-link {{ setActive(['detail_kategori*']) }}" href="{{route('detail_kategori.index')}}">
                                <i class="far fa-circle nav-icon"></i>
                                    <p>Detail Kategori</p>
                                    </a>
                                  </li>
                              

                              </ul>
                            </div>
                          </li> -->

                          <li li class="nav-item">
                            <a class="nav-link " data-toggle="collapse" href="#ui-basic2" aria-controls="ui-basic">
                            <i class="nav-icon fas fa-archive"></i>
                              <p>
                                Kategori  
                                <i class="right fas fa-angle-left"></i>
                              </p>
                            </a>

                            <div class="collapse {{ setShow(['detail_pengeluaran*','detail_kategori*']) }}" id="ui-basic2">
                              <ul class="nav flex-column sub-menu">                 

                                  <!--kas-->
                        
                                  <li class="nav-item">
                                  <a class="nav-link {{ setActive(['detail_kategori*']) }}" href="{{route('detail_kategori.index')}}">
                                  <i class="nav-icon fas fa-caret-up"></i>
                                    <p>Pemasukan</p>
                                    </a>
                                  </li>

                                  <li class="nav-item">
                                  <a class="nav-link {{ setActive(['detail_pengeluaran*']) }}" href="{{route('detail_pengeluaran.index')}}">
                                  <i class="nav-icon fas fa-caret-down"></i>
                                    <p>Pengeluaran</p>
                                    </a>
                                  </li>
                              

                              </ul>
                            </div>
                          </li>

                          <!-- <li class="nav-item">
                            <a class="nav-link {{ setActive(['detail_pengeluaran*']) }}" href="{{route('detail_pengeluaran.index')}}">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>Kategori Pengeluaran</p>
                            </a>
                          </li> -->

                          <!--kas-->
                          <li class="nav-item">
                          
                            <a class="nav-link {{ setActive(['kas*']) }}" href="{{route('kas.index')}}">
                            <i class="far fa fa-credit-card nav-icon"></i>
                            <p>Kas</p>
                            </a>
                          </li>
                      @endif

                    </ul>
                  </div>
                </li>
              @else
                  @if(Auth::user()->petugas)
                      <li li class="nav-item">
                        <a class="nav-link " data-toggle="collapse" href="#ui-basic" aria-controls="ui-basic">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                            Master Data
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>

                        <div class="collapse {{ setShow(['detail_kategori*','kas*']) }}" id="ui-basic">
                          <ul class="nav flex-column sub-menu">
                            
                        
                          <li li class="nav-item">
                            <a class="nav-link " data-toggle="collapse" href="#ui-basic2" aria-controls="ui-basic">
                            <i class="nav-icon fas fa-archive"></i>
                              <p>
                                Kategori  
                                <i class="right fas fa-angle-left"></i>
                              </p>
                            </a>

                            <div class="collapse {{ setShow(['detail_kategori*']) }}" id="ui-basic2">
                              <ul class="nav flex-column sub-menu">
                                       

                                  <!--kas-->
                        
                                  <li class="nav-item">
                                  <a class="nav-link {{ setActive(['detail_kategori*']) }}" href="{{route('detail_kategori.index')}}">
                                  <i class="nav-icon fas fa-caret-up"></i>
                                    <p>Pemasukan</p>
                                    </a>
                                  </li>
                              

                              </ul>
                            </div>
                          </li>


                            <!--kas-->
                            <li class="nav-item">
                            
                              <a class="nav-link {{ setActive(['kas*']) }}" href="{{route('kas.index')}}">
                              <i class="far fa fa-credit-card nav-icon"></i>
                              <p>Kas</p>
                              </a>
                            </li>

                          </ul>
                        </div>
                      </li>
                  @endif
              @endif


            <!-- LAPORAN -->
          @if(Auth::user()->petugas)

          <li class="nav-item">
                
                <a class="nav-link {{ setActive(['lapiran*']) }}" href="{{route('lapiran')}}">
                <i class="nav-icon fas fa-calculator"></i>
                <p>Laporan</p>
                </a>
          </li>
          <!-- 
          <li class="nav-item {{ setActive(['riwayat', '']) }}"> 
          <a class="nav-link {{ setActive(['riwayat*']) }}" href="riwayat">
              <i class="nav-icon fas fa-history"></i>
              <p>
               Riwayat pemasukan_rutin
              
              </p>
            </a>
          </li> -->
          @endif

         
          <!-- GANTI PASSWORD -->
          <li class="nav-item {{ setActive(['password', '']) }}"> 
            <a class="nav-link {{ setActive(['password*']) }}" href="{{route('password')}}">
              <i class="nav-icon fas fa-lock"></i>
              <p>
                Ganti Password
              
              </p>
            </a>
          </li>

          
          
        
          
                <div class="user-panel mt-1 pb-1 mb-1 d-flex">     
                </div>
        
                


            <li class="nav-item {{ setActive(['logout', '']) }}"> 
              <a class="dropdown-item nav-link {{ setActive(['logout*']) }}" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="far fa-stop nav-icon"></i>  
              <p class="text-red">
               
                                        <b>
                
                                          Keluar
                                          
                                        </b>
                                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                              {{ csrf_field() }}
                                          </form>
                </p>
              </a>
            </li>

           
      

          
          
        </ul>