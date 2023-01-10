<?php


namespace App\Http\Services;


use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Support\Facades\Auth;

class SMSGateway
{

    public function sendVerificationCode($data)
    {
        $code = "0000";
        $data["code"] = $code;

        VerificationCode::whereNotNull('user_id')->where(['user_id' => $data['user_id']])->delete();

        return VerificationCode::create($data);
    }

    public function checkOTPCode($code)
    {
        if (auth()->check()) {
            $verificationData = VerificationCode::where('user_id', Auth::id())->first();

            if($verificationData->code == $code){
                User::whereId(Auth::id())->update(['email_verified_at' => now()]);
                return true;
            }else{
                return false;
            }
        }
        return false ;
    }

    public function removeOTPCode($code)
    {
        VerificationCode::where('code', $code)->delete();
    }

}
