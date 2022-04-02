@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
      "iDisplayLength": 10
    });

} );
</script>
@stop
@extends('layouts2.app')

@section('content')

  <div class="content-header">
      <div class="container-fluid">
        <div class="row">

        <div class="col-md-12 col-sm-12 col-12">
            <div class="col-sm-12">
            
            <div class="btn-group">
                                    <a  href="/donasi" type="button" class="btn btn-warning">
                                    <i class="fas fa-undo"></i>
                                    </a>
            </div>
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">Midtrans</li>
              
            </ol>
            </div>
        </div>    

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
  </div>

  <div class="content-header">
                        <div class="container-fluid">
                          <div class="row">

                              <?php
                                $seluruh_pemasukan = DB::table('transaksi')->select(DB::raw('SUM(nominal) as total'))
                                ->where('status','1')
                                ->first();
                    
                                $total = $seluruh_pemasukan->total;
                              ?>

                              <div class="col-md-3">
                                <div class="card card-outline card-warning">
                                    <div class="card-header">
                                      <h3 class="card-title">
                                      <b>Payment Pending</b> 
                                      </h3>
                                    </div>

                                    <div class="card-tools"> 
                                      <div class="card-body ">

                                      <div class="row">
                                        {{$donation->where('status', 'pending')->count()}}
                                      </div>
                                      </div>
                                    </div>
                                </div>
                              </div>

                              <div class="col-md-3">
                                <div class="card card-outline card-success">
                                    <div class="card-header">
                                      <h3 class="card-title">
                                      <b>Payment Succeess</b> 
                                      </h3>
                                    </div>

                                    <div class="card-tools"> 
                                      <div class="card-body ">

                                      <div class="row">
                                       {{$donation->where('status', 'success')->count()}}
                                      </div>
                                      </div>
                                    </div>
                                </div>
                              </div>

                              <div class="col-md-3">
                                <div class="card card-outline card-danger">
                                    <div class="card-header">
                                      <h3 class="card-title">
                                      <b>Payment Failed</b> 
                                      </h3>
                                    </div>

                                    <div class="card-tools"> 
                                      <div class="card-body ">

                                      <div class="row">
                                      {{$donation->where('status', 'failed')->count()}}
                                      </div>
                                      </div>
                                    </div>
                                </div>
                              </div>

                              <div class="col-md-3">
                                <div class="card card-outline card-dark">
                                    <div class="card-header">
                                      <h3 class="card-title">
                                      <b>Payment Expired</b> 
                                      </h3>
                                    </div>

                                    <div class="card-tools"> 
                                      <div class="card-body ">

                                      <div class="row">
                                      {{$donation->where('status', 'expired')->count()}}
                                      </div>
                                      </div>
                                    </div>
                                </div>
                              </div>

                             

                          </div>
                         </div>       
                      </div>



  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Data Midtrans Payment</h3>
                  </div>
                  <div class="card">
                  </div>

                  <div class=" table-responsive col-md-12 col-sm-12 col-12">
                    <table  id="example1" class="table table-striped">
                        <thead> 
                        <tr>
                        <th width="1%">NO</th>
                        <th class="text-center">KODE</th>
                        <th class="text-center">NAMA</th>
                        <th class="text-center">EMAIL</th>
                        <th class="text-center">JENIS</th>
                        <th class="text-center">NOMINAL</th>
                        <th class="text-center" >STATUS</th>
                        <th class="text-center" >UPDATE</th>

                        </tr>
                        </thead>
                        <tbody>
                          @php
                          $no = 1;
                          @endphp
                          @foreach($donation as $k)
                          <tr>
                            <td class="text-left">{{ $no++ }}</td>
                            <td>{{ $k->transaction_id }}</td>
                            <td>{{ $k->donor_name }}</td>
                            <td>{{ $k->donor_email }}</td>
                            <td>{{ $k->donation_type }}</td>
                            <td class="text-right">{{ "Rp.".number_format($k->amount).",-" }}</td>
                            <td class="text-center">
                          
                                                            @if($k->status  == 'success')
                                                              <span class="badge bg-success col-md-8">{{ $k->status }}</span>
                                                            @elseif($k->status  == 'failed')
                                                              <span class="badge bg-danger col-md-8">{{ $k->status }}</span>    
                                                            @elseif($k->status  == 'pending')
                                                              <span class="badge bg-warning col-md-8">{{ $k->status }}</span>    
                                                            @else($k->status  == 'expired')
                                                              <span class="badge bg-dark col-md-8">{{ $k->status }}</span>    
                                                            @endif
                            </td>
                            <td class="text-center">{{ $k->updated_at->diffForHumans() }}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                  </div>

            </div>
        </div>
      </div>
    </div>
  </section>



@endsection


