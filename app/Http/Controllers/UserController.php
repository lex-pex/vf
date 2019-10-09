<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;


class UserController extends Controller
{
    public function cabinet() {
        $editButton = true;
        $category_id = 1;
        $user = Auth::user();
        $adminButton = $user->role == 'admin';
        if ($user) {
            return view('user.cabinet', [
                'headers' => $this->getProfileHeaders($user),
                'currentCategory' => $category_id,
                'user' => $user,
                'edit' => $editButton,
                'admin' => $adminButton
            ]);
        } else return redirect(route('index')); // 404
    }

    public function userEdit($user_id = '') {
        if(!is_numeric($user_id)) return redirect()->back();
        $auth = Auth::user();
        if($user_id == $auth->id || $auth->role === 'admin') {
            $user = User::find($user_id);
        } else {
            return redirect()->back();
        }
        return view('user.edit', [
            'headers' => $this->getProfileHeaders($user),
            'currentCategory' => 1,
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user) {
        $this->validate($request, [
            'email' => 'unique:users|max:255',
            'name' => 'unique:users|max:255',
            'about' => 'max:1000',
//            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            'image' => 'image|mimes:jpeg,jpg|max:2048'
        ]);
        User::updateUser($user, $request);
        return redirect(route('profile', [$user->id]));
    }

    public function profileDelete(Request $request, User $user) {
        if(Auth::user()->role !== 'admin') {
            $request->session()->invalidate();
        }
        User::userDelete($user);
        return redirect(route('index'));
    }

    public function passwordReset(Request $request) {
        $request->session()->invalidate();
        return redirect('password/reset');
    }

    // Preparing profile headers
    private function getProfileHeaders($user)
    {
        return [
            'pageTitle' => 'Пользователь ' . $user->name . ' - Vegans Freedom',
            'url' => route('profile', ['id' => $user->id]),
            'title' => $user->name,
            'description' => $this->postDescription($user->about),
            'image' => URL::asset($user->avatar)
        ];
    }

    private function postDescription($text)
    {
        $descriptionArray = explode(' ', $text);
        $descriptionArray = array_slice($descriptionArray, 0, 30);
        return implode(' ', $descriptionArray);
    }

}





