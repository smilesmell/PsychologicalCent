<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    public function login(Request $request)
    {

        $credentials['name'] = $request->name;
        $credentials['password'] = $request->number;
        //找到该用户
        if ($user = Student::where('name',$credentials['name'])->first()) {
            //账号密码匹配
            if ($credentials['password'] == $user->number) {
                $token = Auth::guard()->fromUser($user);
                return response()->json( [
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'expires_in' => Auth::guard()->factory()->getTTL() * 60
                ])->setStatusCode(200);
            } else {
                //账号密码不匹配
                return response()->json([
                    'message' => '用户名或密码错误'
                    ]);
            }
        }else{
            //未找到该用户
            return response()->json([
                'message' => '该用户不存在'
            ]);
        }


    }


    public function me(Request $request)
    {
        $number = $request->number;
        $informations = Student::where('number',$number)->get();
        foreach ($informations as $key => $value) {
            $values = $value->information;
        }
        return response()->json([
            'message' => '查询成功',
            'data'    => $values
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => '成功退出登录']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
