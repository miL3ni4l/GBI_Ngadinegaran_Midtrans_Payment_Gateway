@extends('layouts2.utama')

@section('content')



    <section >
        <div class="container">

            <div class="row">
                <div class="col-lg-12 text-center" style="padding-top:5%;padding-bottom:30px">
                    <h4 class="section-heading text-uppercase">Jadwal Ibadah Gereja</h4><br>
                </div>
            </div>
         
           

                      
                                <!-- HASIL -->

                        
                                            <div class="row text-left"> 

                                                <div class="col-md-12 border-rounded">
                                                    <div class="alert alert-secondary center-block">
                                                            
                                                        <table id="example1" class="table table-bordered table-striped">
                                                            <thead> 
                                                                <tr>
                                                                <th width="1%">NO</th>
                                                                <th class="text-center">IBADAH</th>
                                                                <th class="text-center">JAM</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            @php
                                                            $no = 1;
                                                            @endphp
                                                            @foreach($ibadah as $k)
                                                            <tr>
                                                                <td class="text-center">{{ $no++ }}</td>               
                                                                <td class="text-left">{{ $k->ibadah }}</td>
                                                                <td class="text-center">{{ $k->waktu_ibadah }}</td>
                                                            </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>

                                            </div>

                 


                    
    
        </div>
    </section>
@endsection