<?php

namespace App\Http\Controllers\API\Auth;


use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\RegistUserRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    //register step 1 and sendcode RegistUserRequest
    public function register( Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // إنشاء المستخدم
            $data = User::create([
                "name" => $validatedData['name'],
                "phone" => $validatedData['phone'],
                "email" => $validatedData['email'],
                'code' => rand(1000, 9999),
                "password" => Hash::make($validatedData['password']),
                'expired_at' => now()->addMinutes(5),
            ]);

            return response()->json([
                "status" => 200,
                "data" => $data,
                "message" => "تم تسجيل الدخول بنجاح مرحبا بك ✔"
            ], 200);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
            return response()->json([
                "status" => 422,
                "errors" => $errors
            ], 422); // تأكد من أن الحالة هي 422 هنا
        } catch (Exception $e) {
            return response()->json([
                "status" => 500,
                "message" => "حدث خطأ غير متوقع."
            ], 500);
        }
    }
    //register step 2 verifyPhoneCode
    public function verifyPhoneCode($phone,Request $request)
    {
        try{
            $validator = Validator::make($request->all(),[
                         'code' => 'required|exists:users,code'
                       ]);

            if ($validator->fails()) {
                return response()->json([
                    "status"=>422,
                    "message"=>$validator->errors(),
                ],422);
               }

                $user=User::where('phone',$phone)->first();
            if($user){
                if($user->code != $request->input('code')){
                    return response()->json([
                        "status"=>422,
                        "message"=> $validator->errors(),
                    ],422);
                }
                if($user->expired_at < now()){
                    return response()->json([
                        "status"=>422,
                        "message"=>'Time of code is expired ,please resend code again!',
                    ],422);
                    }
                    $user->update([
                        'code'=>null,
                        'expired_at'=>null
                    ]);
            $token = $user->createToken($user->phone,['*'],now()
            ->addMonth())->plainTextToken;

            return response()->json([
                "status"=>200,
                "data"=>[
                    'id'=>$user->id,
                    'phone' => $user->phone,
                    'token' => $token,
                    'token_type'=>"bearer"
                ]
            ],200);

            }else{
              return response()->json([
                  "message"=>'User Not Found' ],404);
            }

            }catch(\Exception $ex){
                return response()->json([
                    "message"=>'internal server error..'
                ],500);
            }
    }
    //resend code if code expaired
    public function resendCode($phone)
    {
        try{
            $user=User::where('phone',$phone)->first();
            if($user){
                $code=rand(1000,9999);
                $user->update([
                'code'=>$code,
                'expired_at'=>now()->addMinutes(5)
                ]);

                return response()->json([
                    "status"=>200,
                    "data" => new UserResource($user)
                ]);
            }else{
                return response()->json([
                    "status"=>404,
                    "data"=>$user,
                    "message"=>'User Not Found'
                ],404);
            }

            }catch(\Exception $ex){
                return response()->json([
                  "message"=>'internal server error',
                ],500);
            }
    }

    //login
    public function login(Request $request)
    {
       $data= $request->validate([
            "phone"=>"required|numeric",
            "password"=>"required|min:8",
        ]);
        if (!Auth::attempt(['phone' => $data['phone'], 'password' => $data['password'] ])) {
            return response()->json([
                "status"=>401,
                'message' => 'Unauthorized'], 401);
        }
        $user = Auth::user();

        if(!$user){

           return response()->json([
                "status"=>404,
               "message"=>"UserNotFound"],404);
        }
        $user=User::findOrFail($user->id);
        $token = $user->createToken($user->phone, ['*'], now()->addMonth())->plainTextToken;
        $data=[
            "id"=>$user->id,
            "name"=>$user->name,
            "email"=>$user->email,
            "phone"=>$user->phone,
            "photo"=>is_null($user->photo) ? null : asset('/images/'. $user->photo),
            "token"=>$token,
         ];
        return response()->json([
            "status"=>200,
           "data"=>$data,
        ],200);
    }
    //reset password

    //logout
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                "status"=>200,
                "message"=>'user logged out Successfully',
            ],200 );
        } catch (\Exception $e) {
            return response()->json([
                "status"=>500,
                'message'=>'internal serever Error,,'],500);
        }
    }
    // get current user
    public function getAuthUser()
    {
        $user=User::findOrFail(Auth()->id());
        return response()->json([
            "status"=>200,
            "data"=>new userResource($user)
        ],200);
    }
    public function resetPassword($phone,Request $request)
    {
        try{
            $validator = Validator::make($request->all(),[
                    'code' => 'required|exists:users,code',
                    'password' => ['required','confirmed',Password::min(8)]
                ]);
            if ($validator->fails()) {
                return response()->json([
                     "message"=> $validator->errors()],422);
            }
            $user=user::where('phone',$phone)->first();
            if($user){
                if($user->code !=$request->input('code')){
                    return response()->json([
                        "status"=>422,
                        "message"=> 'code is wrong, write it again'],422);
                }
                if($user->expired_at < now()){
                    return response()->json([
                        "status"=>422,
                        "message"=> 'Time of code is expired ,please resend code again!'],422);
                }
                if(Hash::check($request->input('password'),$user->password)){
                    return response()->json([
                        "status"=>404,
                        "message"=> 'you can\'t use old password as new password'],404);
                }
                $user->update([
                    'password'=>bcrypt($request->input('password')),
                    'code'=>null,
                    'expired_at'=>null
                ]);
                $token=$user->createToken($user->phone)->plainTextToken;
                $data = [
                    'id'=>$user->id,
                    'name' => $user->name,
                    'phone' => $user->phone,
                    'email' => $user->email,
                    // 'photo' =>!$request->hasFile('photo')? null: BASEURLPHOTO . $user->photo,
                    'token' => $token,
                    'token_type'=>"bearer"
                ];
                 return response()->json([
                     "status"=>200,
                     "message"=>'password changed successfully',
                     "data"=>$data
                 ],200);
            }else{
                return  response()->json([
                    "status"=>404,
                    "message"=>'user Not Found',
                ],404);
            }

        }catch(\Exception $ex){
            response()->json([
                "message"=>'internal server error..',
            ],500);
        }
    }
    public function update_profile(Request $request)
    {
        try {
            $data = $request->validate([
                'name'=>'nullable|string',
                'email'=>'nullable|email|max:254',
                'photo'=>'nullable|image|mimes:jpeg,png,jpg',
                "phone" => "nullable|numeric|"
            ]);
            $id = Auth::user()->id;
            $user=User::findOrFail($id);
            if ($request->hasFile('photo')) {
                if ($user->photo) {
                    Storage::disk('image')->delete($user->photo);
                }
                $data['photo'] = $request->file('photo')->store('profiles/' .$id, 'image');
            }
            $user->update($data);
            return response()->json([
                "status" => 200,
                "data" => new UserResource($user)
            ], 200);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
            return response()->json([
                "status" => 422,
                "msg" => $errors,
            ], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "status" => 404,
                "msg" => "هذا السجل غير موجود",
            ], 404);
        }


    }

}
