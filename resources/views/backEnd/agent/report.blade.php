@extends('backEnd.layouts.master')
@section('title','Hub report')
@section('content')
<form action="{{url('admin/hub/report')}}" method="get">
@csrf
    <div class="row p-2">
        <div class="col-md-6">
        <div class="col-md-6">
            <select name="agent" id="" class="form-control">
            <option value="">Select Agent</option>
                @foreach($agent as $a)
                <option <?php if ($aid==$a->id) {
                  echo "selected";
                } ?> value="{{$a->id}}">{{$a->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-6">
            <input type="date" class="flatDate form-control" placeholder="Date Form" name="startDate" value="{{$dates}}">
        </div>
        <!-- col end -->
        <div class="col-sm-6">
            <input type="date" class="flatDate form-control" placeholder="Date To" name="endDate" value="{{$datee}}">
        </div>
        <div class="col-sm-6">
            <input type="submit" class=" form-control" value="submit">
        </div>
        </div>
        <div class="col-sm-6">
        <section class="content">
    <div class="container-fluid">
        <div class="box-content">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="card custom-card">
                       
                        <div class="card-body">
                            <div class="row " id="examp">
                               

                                <div class="col-md-12" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Transaction Request</h5>
                                            
                                        </div>
                                        <div class="modal-body">

                                        <table id="" class="table  table-striped">
                                              <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Hub </th>
                                                    <th>Date</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($transaction as $tran)
                                              
                                            <tr>
                                                <td>{{$tran->id}}</td>
                                                <td><?php $dman= App\Agent::where('id',$tran->agent_id)->first(); ?>{{@$dman->name}}</td>
                                                <td>{{$tran->created_at}}</td>
                                                <td>{{$tran->amount}}</td>
                                                <td>@if($tran->status==null)
                                                  <span class="btn btn-sm btn-danger">Padding</span>
                                                  @else
                                                  <span class="btn btn-sm btn-success">Accepted </span>
                                                  @endif
                                                </td>
                                                <td>@if($tran->status==null)
                                                    <a href="{{url('admin/hub/transtion/'.$tran->id)}}" class="btn btn-sm btn-dark">Got it</a>
                                                    @endif

                                                </td>
                                            </tr>
                                            
                                                @endforeach
                                             {{$transaction->links()}}
                                                </tbody>
                                            </table>

                                        </div>


                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
</section>
        </div>
    </div>
</form>
<div class="card-body">
    <table id="example" class="table table-bordered table-striped custom-table table-responsive">
        <thead>
            <tr>
                <th>Id</th>
                <th>Company Name</th>
                <th>Ricipient</th>
                <th>Tracking ID</th>

                <th>Address</th>
                <th>Phone</th>
                <th>Rider</th>
                <th>Agent</th>
                <th>L. Update</th>
                <th>Status</th>
                <th>Total</th>
                <th>Charge</th>
                <th>Sub Total</th>

            </tr>
        </thead>
        <tbody>
            @foreach($parcels as $key=>$value)
            <tr>
                <td>{{$loop->iteration}}</td>
                @php
                $merchant = App\Merchant::find($value->merchantId);
                $agentInfo = App\Agent::find($value->agentId);
                $deliverymanInfo = App\Deliveryman::find($value->deliverymanId);
                @endphp
                <td>{{$merchant->companyName}}</td>
                <td>{{$value->recipientName}}</td>
                <td>{{$value->trackingCode}}</td>

                <td>{{$value->recipientAddress}}</td>
                <td>{{$value->recipientPhone}}</td>
                <td>@if($value->deliverymanId) {{$deliverymanInfo->name}} @endif</td>
                <!-- Modal -->

                <!-- Modal end -->
                <td>@if(@$value->agentId) {{@$agentInfo->name}} @endif</td>
                <!-- Modal -->

                <!-- Modal end -->
                <td>{{$value->updated_at}}</td>
                <td><?php    $parceltype = App\Parceltype::where('id',$value->status)->first(); ?>{{@$parceltype->title}}
                </td>
                <td> {{$value->cod}}</td>
                <td> {{(int)$value->deliveryCharge+(int)$value->codCharge}}</td>
                <td> {{(int)$value->cod-(int)($value->deliveryCharge+$value->codCharge)}}</td>

            </tr>
            @endforeach
       
    </table>
    {{$parcels->links()}}
    <table id="" class="table  table-striped">
        <thead>
            <tr>
                <th>Parcel</th>
                <th>Delivered</th>
                <th> Panding</th>
                <th>Cancelled</th>
                <th>Returned to Merchant</th>
                <th>Picked</th>
                <th>In Transit</th>
                <th>Hold</th>
                <th>Return Pending</th>
                <th>Return To Hub</th>

                <th>Cod Price</th>
                <th>Delivery Charge</th>
                <th>Cod Charge</th>
                <th>Collected Amount</th>


            </tr>
        </thead>
        <tbody>

            <tr>
                <td>
                    {{$parcelcount}}
                </td>
                <td>
                    {{$parcelr}}@if($parcelr)({{round(($parcelr*100)/$parcelcount,2)}}%)
                    @endif
                </td>
                <td>{{$parcelpa}}@if($parcelpa)({{round(($parcelpa*100 )/$parcelcount,2)}}%)
                    @endif
                </td>
                <td>{{$parcelc}}@if($parcelc)({{round(($parcelc*100)/$parcelcount,2)}}%)
                    @endif</td>
                <td>{{$parcelre}}@if($parcelre)({{round(($parcelre*100)/$parcelcount,2)}}%)@endif</td>
                <td>{{$parcelpictd}}@if($parcelpictd)({{round(($parcelpictd*100)/$parcelcount,2)}}%)@endif
                </td>
                <td>{{$parcelinterjit}}@if($parcelinterjit)({{round(($parcelinterjit*100)/$parcelcount,2)}}%)@endif
                </td>
                <td>{{$parcelhold}}@if($parcelhold)({{round(($parcelhold*100)/$parcelcount,2)}}%)
                    @endif</td>
                <td>{{$parcelrrtupa}}@if($parcelrrtupa)({{round(($parcelrrtupa*100)/$parcelcount,2)}}%)@endif
                </td>
                <td>{{$parcelrrhub}}@if($parcelrrhub)({{round(($parcelrrhub*100)/$parcelcount,2)}}%)
                    @endif</td>

                <td>{{$parcelpriceCOD}}</td>
                <td>{{$deliveryCharge}}</td>
                <td>{{$codCharge}}</td>
                <td>{{$Collectedamount}}</td>


            </tr>

        </tbody>
    </table>
</div>

@stop