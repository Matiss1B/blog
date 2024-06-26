<?php

namespace App\Http\Middleware;

use App\Models\API\V1\Tokens;
use Closure;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Check the token using the checkToken method
        if (self::checkToken($request->header('Authorization')) !== false) {
            // Token is valid, proceed with the request
            $token = Tokens::where("token", $request->header('Authorization'))->first();
            $timestamp = Carbon::parse($token->updated_at);
            $currentTimestamp = Carbon::now();
            if ($currentTimestamp->diffInMinutes($timestamp) >= 30) {
                Session::flush();
                Tokens::where("token",$request->header('Authorization'))->delete();
                return response()->json(["Message"=> "Unauthorised!", "status"=>401], 401);
            }else {
                $data = [
                    "updated_at"=>Carbon::now()->format('Y-m-d H:i:s'),
                ];
                Tokens::where("token",$request->header('Authorization'))->update($data);
                Session::put("user_id", self::checkToken($request->header('Authorization')));
                return $next($request);
            }
        } else {
            // Token is invalid, handle the error
            return response()->json(["Message"=> "Unauthorised!", "token"=>$request->header('Authorization'), "status"=>401], 401);
        }
    }

    public static function checkToken($user)
    {
        $token = Tokens::where("token", $user)->first();
        if($token){
            return $token->user_id;
        }
        return false;
    }
}
