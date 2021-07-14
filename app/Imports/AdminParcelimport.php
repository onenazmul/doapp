<?php
namespace App\Imports;
use App\Codcharge;
use App\Parcel;
use App\Deliverycharge;
use App\Discount;
use Maatwebsite\Excel\Concerns\ToModel;
use Session;
use Auth;
class AdminParcelimport implements ToModel
{
  public function model(array $row)
    {
    // dd($row);
      if (!isset($row[0]) || !isset($row[1]) || !isset($row[2]) || !isset($row[3]) || !isset($row[4]) || !isset($row[5]) || !isset($row[6]) || !isset($row[7]) || !isset($row[8])) {
            return NULL;
        }
         $merchant=Discount::where('maID',$row[6])->where('delivery_id',$row[7])->first();
        //  dd($merchant);
        $dis=0;
        if($merchant){
           $dis+= $merchant->discount;
        }
        $intialdcharge = Deliverycharge::find($row[7]);
        $initialcodcharge = Codcharge::where('status',1)->orderBy('id','DESC')->first();
      // fixed delivery charge
     if($row[5]>1 || $row[5]!=NULL){
        $extraweight = $row[5]-1;
        $deliverycharge =  (($intialdcharge->deliverycharge*1)+($extraweight*$intialdcharge->extradeliverycharge))-$dis;
        $weight = $row[5];
     }else{
        $deliverycharge =($intialdcharge->deliverycharge)-$dis;
       $weight = 1;
     }
     // fixed cod charge
     if($row[2] > 100){
    //    $extracodcharge = 0;
    //    $codcharge = Session::get('codcharge')+$extracodcharge;
    $codcharge = 0;
     }else{
    //   $codcharge= Session::get('codcharge');
    $codcharge = 0;
     }
    $all=Parcel::all()->count();
       return new Parcel([
           'recipientName'    => $row[0],
           'percelType'       => 1,
           'user'       => Auth::user()->name,
           'recipientPhone'   => $row[1],
           'cod'              => $row[2],
           'recipientAddress' => $row[3],
           'agentId' =>  $row[4],
           'reciveZone'       =>7,
           'productWeight'    => $row[5],
           'merchantId'       => $row[6],
           'invoiceNo'       => $row[8],
           'trackingCode'     => 99999+$all+1,
           'deliveryCharge'   => $deliverycharge,
           'codCharge'        => $codcharge,
           'merchantAmount'   => (int)($row[2])-(int)($deliverycharge+$codcharge),
           'merchantDue'      => (int)$row[2]-(int)($deliverycharge+$codcharge),
           'codType'          => $intialdcharge->id,
           'orderType'        => $initialcodcharge->id,
           'status'           => 2,
        ]);

    }
}




  