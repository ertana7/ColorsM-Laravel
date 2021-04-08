<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Color;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index () {
        return view('users.index', [
            'users' => User::with('colors')->get()
        ]);
    }

    public function addUserColor ($user) {
        return view('users.add-color', [
            'user' => $user,
            'colors' => Color::all()
        ]);
    }

    public function deleteUserColor ($user) {
        return view('users.delete-color', [
            'user' => $user,
            'colors' => Color::all()
        ]);
    }

    public function addNewUserColor($user, $color){
        User::find($user)->colors()->attach($color);
        $this->changeUserHexValue($user, $color);

        return redirect()->route('users.index');
    }

    public function deleteExistingUserColor($user, $color){
        $totalUserColorRecords = DB::table('color_user')->where(array('user_id' => $user))->count();

        if($totalUserColorRecords > 1){
            DB::table('color_user')->where(array('user_id' => $user, 'hex_value' => $color))->delete();

            if(User::find($user)->hex_value == $color){
               $this->changeUserHexValue($user, null);
            }

            return redirect()->route('users.index');
        }else{
            return redirect()->back()->with('error', 'No colours can be deleted because the user only has one linked with itself!');
        }
    }

    public function changeUserHexValue($user, $color){
        $existingUser = User::find($user);
        $existingUser->hex_value = $color;
        $existingUser->save();

        return redirect()->route('users.index');
    }

    public function addUser($name, $email, $password, $hex_value){
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->hex_value = $hex_value;
        $user->save();
    }
    
    public function deleteUser($email){
        User::where('email', '=', $email)->delete();
    }

    public function getUserColor ($email){
        return User::where('email', '=', $email)->pluck('hex_value');
    }

    public function getUsers () {
        $returningData = [];
        $users =  User::with('colors')->get();

        foreach($users as $user){
            echo $user->colors->hex_value;
        }
    }
}
