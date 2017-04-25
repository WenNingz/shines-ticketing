<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Role;
use App\SocialAccount;
use App\SocialAccountService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Laravel\Socialite\Contracts\User as ProviderUser;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->only(['index', 'delete']);
        $this->middleware('permission:social-index')->only('index');
        $this->middleware('permission:social-delete')->only('delete');
    }

    public function redirect($provider) {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider) {
        $user = $this->createOrGetUserFacebook(Socialite::driver($provider)->user(), $provider);

        auth()->loginUsingId($user->id);

        return redirect('/dashboard');
    }

    public function createOrGetUserFacebook(ProviderUser $providerUser, $provider) {
        $account = SocialAccount::whereProvider($provider)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            $user = User::find($account->user->id);
            $user->status = 3;
            $user->save();
            return $account->user;
        } else {

            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $provider
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {

                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'first_name' => $providerUser->getName(),
                    'password' => Hash::make(str_random(10)),
                    'status' => 3
                ]);
                $attendee = Role::where('name', 'attendee')->first();
                $user->attachRole($attendee);
            }

            $user->status = 3;
            $user->save();

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }

    public function index() {
        $user = auth()->user();
        $social_accounts = $user->socialAccounts;
        return view('attendee.linked-account', [
            '_active' => 'linked-account',
            'social_accounts' => $social_accounts
        ]);
    }

    public function delete() {
        SocialAccount::find(Input::get('account_id'))->delete();

        return redirect('linked-accounts');
    }
}
