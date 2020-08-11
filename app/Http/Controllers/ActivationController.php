<?php

namespace App\Http\Controllers;

use App\ActivationCode;
use App\Events\ActivationCodeEvent;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ActivationController extends Controller
{
    public function activate(ActivationCode $code) {
        try {
            // start the DB transaction
            DB::beginTransaction();

            // delete the code from the database
            $code->delete();

            // update the active status
            $code->user()->update(['active' => true]);

            // commit the transaction
            DB::commit();

            // login the user
            Auth::login($code->user);

            // redirect to home page
            return redirect('/home');
            
        } catch (\Exception $error) {
            DB::rollback();
            return redirect('/login')
                ->withError($error->getMessage());
        }
    }

    public function resendCode(Request $request) {
        // get the user from email
        $user = User::whereEmail($request->email)->firstOrFail();

        // if user is active redirect user to home page
        if ($user->userIsActive()) {
            return redirect('/home');
        }

        event(new ActivationCodeEvent($user));

        return redirect('/login')
            ->withSuccess('Your Code has been sent. Please check your email');
    }
}
