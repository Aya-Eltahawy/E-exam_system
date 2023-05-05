<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Department;
use App\Models\Student;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function App\CPU\translate;

class StudentController extends Controller
{

    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'level_id' => 'required|numeric|min:0|max:5',

        ]);

        $student = new Student();
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->password = $request->input('password');
        $student->level_id = $request->input('level_id');
        $student->department_id = $request->input('department_id');
        $student->rank = $request->input('rank');
        $student->save();

        $departments = Department::all();

        if ($request->fails())
            return response()->json([
                'status' => 'false',
                'data' => $request->errors()->all()
            ], 200);

        $inputs = $request->all();
        Student::create($inputs);


        return response()->json([
            'status' => 'true',
            'message' => 'student registered successfully',
            'data' => $this->createNewToken(auth()->attempt($request->only(['email', 'password'])))
        ], 200);
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)){
            $student = Auth::user();
            $token = $student->createToken('authToken')->accessToken;

            return response()->json([
                'message' => 'student login successfully',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'data' => $student
            ], 200);

        }
        else{
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

    }


    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }

//    public function userProfile()
//    {
//        return response()->json([
//            'massage' => 'success',
//
//        ]);
//        return $this->responseApi('success', translate('get_data_success'), new UserResource(auth()->user()));
//    }


    public function editProfile(Request $request)
    {
        $validator = validator($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'level_id' => 'required|numeric|min:0|max:5',
        ]);


        if ($validator->fails())
            return response()->json([
               'status' => 'false',
               'data' =>  $validator->errors()->all()
            ]);

        auth()->user()->update($validator->validated());

//        return responseApi('success', __('api.user profile update'), auth()->user());

        return response()->json([
            'status' => 'success',
            'massage' => 'api.user profile update',
            'data' =>  auth()->user()
        ]);
    }

    //logout function
    public function logout(Request $request){
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'successfully logged out',
        ]);
    }




    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function responseApi(string $string, $translate, UserResource $param)
    {
    }
}
