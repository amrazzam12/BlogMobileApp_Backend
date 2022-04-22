<?php

namespace App\Services;

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

        if ($this->requestType == 'API'){
            $this->users = User::all();

            if (count($this->users) == 0)
                return $this->returnError( 'No Users Found');

            return $this->returnData(
                'Success', 'Data Returned' , $this->users
            );
        } else {
            $this->users = User::simplePaginate(10);
            $users = count($this->users) > 0 ? $this->users : null;
            return view('users.index' , [
                'users' => $this->users
            ]);
        }
    }
    public function getSpecificUser($id) {

        if ($this->requestType == 'API'){

            $this->user = User::query()->find($id);

            if (!$this->user)
                return $this->returnError();
            return $this->returnData('Success' , 'Data Returned' , $this->user);
        } else {
            // Normal Action Here
        }

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

    public function deleteUser( $user) {



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
            return $this->returnData('Success' , 'Your Profile' , $request->user());
        }

}
