<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\throwException;


class UserServices
{
    use ApiTrait;

    public function __construct($type = 'API')
    {
        $this->requestType = $type;
    }


    private $requestType;
    protected $users;
    protected $user;

    public function getAllUsers() {
        $this->users = UserResource::collection(User::simplePaginate(10));
            $users = count($this->users) > 0 ? $this->users : null;
            return view('users.index' , [
                'users' => $users
            ]);
        }

    public function getSpecificUser($id) {

            $this->user = new UserResource(User::find($id));
            if (! $this->user['name'])
                return $this->returnError();
            return $this->returnData('Success' , 'Data Returned' , $this->user);
    }

    public function updateUser($request , $user) {

        if ($this->requestType == 'API')
            $user = $request->user();

        $validate = Validator::make($request->all() , [
            'name' => 'required|max:255',
            'email' => ['email' , 'required' , Rule::unique('users' , 'email')->ignore($user['id'])]
        ]);

        if (! $validate->fails()){
            $user->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

            if ($this->requestType == 'API')
                return $this->returnSuccess('User Updated!');

             toastr()->success('User Updated Successfully !!');
             return back();

        }

        return $validate->errors();



    }

    public function deleteUser($user) {



        try {
            $user->delete();
            $msg = 'User Deleted Successfully';
            if ($this->requestType == 'API')
                return $this->returnSuccess($msg);

             toastr()->error($msg);
             return back();
        } catch (\Exception $e){
            return throwException($e);
        }

        }

        public function getMyProfile($request): JsonResponse
        {
            $myAcc = $request->user();
            return $this->returnData('Success' , 'Your Profile' ,(new UserResource($myAcc)));
        }

}
