<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function notifications()
    {
        $user=Auth::user();
        if(!$user){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $notifications = DB::table('notifications')
            ->where('notifiable_id', $user->id) // Assuming 'notifiable_id' links notifications to users
            ->select('id', 'notifiable_id','read_at', 'data', 'created_at', 'updated_at')
            ->get();
         $data=[];
    if(count($notifications) >0){
            foreach ($notifications as $notification) {
                $data_decode =json_decode($notification->data,true);
                    $data_push=[
                        "id" => $notification->id,
                        "read_at"=>isset($notification->read_at) ? $notification->read_at : null,
                        "stok_cost" => $data_decode['stok_name'] ?? 'No stok_cost',
                        "stok_code" => $data_decode['stok_code'] ?? 'No stok_code',
                        "buy_price" => $data_decode['buy_price'] ?? 'No buy_price',
                        "created_at" => $notification->created_at,
                        "message" => $data_decode['message'],
                    ];
                array_push($data,$data_push);
            }
            return response()->json([
                'data'=>$data
            ]);
       }else{
        return response()->json(['data'=>'not found Notifications'],200);
       }
    }
    public function auth_unread_notifications()
    {
       $user=Auth::user();
       $notifications= DB::table('notifications')->where('notifiable_id',$user->id)->whereNull('read_at')->select('id','data','created_at','read_at')->get();
        if (count($notifications)>0) {
            $data=[];
                foreach ($notifications as $notification) {
                    $data_decode =json_decode($notification->data,true);
                    $data_push=[
                        "id" => $notification->id,
                        "stok_cost" => $data_decode['stok_name'] ?? 'No stok_cost',
                        "stok_code" => $data_decode['stok_code'] ?? 'No stok_code',
                        "buy_price" => $data_decode['buy_price'] ?? 'No buy_price',
                        "created_at" => $notification->created_at,
                        "message" => $data_decode['message'],
                    ];
                    array_push($data,$data_push);
                }
                return response()->json([
                    "data"=>$data
                ],200);
        }else{
            return response()->json([
                "massage"=>'not found Notifications'
            ],200);
        }
    }
    public function auth_read_notifications()
    {
        $user=auth()->user();
        if($user->unreadNotifications){
            $user->unreadNotifications->markAsRead();
            return response()->json(['data'=> 'All Notification marked as read successfully!'], 200);
        }else {
            return response()->json(['data'=>'not found Notifications'],200);
        }
    }
    public function auth_read_notification($id)
    {
        $notification = DB::table('notifications')->where('id', $id)->first();

        if (isset($notification)) {
            if ($notification->read_at != null) {
                return response()->json(['data' => 'notification has been marked as read already'], 200); // specify a status code
            }

            DB::table('notifications')
                ->where('id', $id)
                ->update(['read_at' => now()]); // update the read_at field

            $notificationfind = DB::table('notifications')->where('id', $id)->first();
            $notificationdata = json_decode($notification->data, true);
            $createdAt = Carbon::parse($notification->created_at);
            $data = [
                "id" => $notification->id,
                "stok_cost" => $notificationdata['stok_name'] ?? 'No stok_cost',
                "stok_code" => $notificationdata['stok_code'] ?? 'No stok_code',
                "buy_price" => $notificationdata['buy_price'] ?? 'No buy_price',
                "created_at" => $createdAt->diffForHumans(),
                "read_at" => $notificationfind->read_at,
            ];

            return response()->json(['data' => $data], 200);
        } else {
            return response()->json(['data' => 'not found Notifications'], 404);
        }
    }
    public function auth_delete_notifications()
    {
    $user=auth()->user();
    $user->notifications()->delete();
       return response()->json([
        'massage' => "delete notifications"
       ]);
    }
}
