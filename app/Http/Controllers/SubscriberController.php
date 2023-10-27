<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriberRequest;
use App\Mail\SubscriberNotificationMail;
use App\Models\Subscriber;
use App\Models\User;
use App\Notifications\SubscriberNotification;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\DNSCheckValidation;
use Egulias\EmailValidator\Validation\MultipleValidationWithAnd;
use Egulias\EmailValidator\Validation\RFCValidation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class SubscriberController extends Controller
{
    /**
     * Used to save subscriber emails from our newsletter
     * @param \App\Http\Requests\SubscriberRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function subscribe(SubscriberRequest $request): RedirectResponse
    {

        // Get the validated email address from the request
        $email = $request->validated('email');
        // Create an instance of the email validator
        $validator = new EmailValidator();
        // Configure multiple validations to apply (RFCValidation and DNSCheckValidation)
        $multipleValidations = new MultipleValidationWithAnd([
            new RFCValidation(),
            new DNSCheckValidation()
        ]);
        if ($validator->isValid($email, $multipleValidations)) {
            $subscriber = Subscriber::create($request->validated());
            //mailling for subscriber
            $notification = new SubscriberNotificationMail();
            Mail::to($email)->send($notification);
            //Mailing for administrator
            $usersToNotify = User::where('role', '!=', 1)->get();
            // Browse all users and send them the notification
            foreach ($usersToNotify as $user) {
                $user->notify(new SubscriberNotification());
            }

            return Redirect::back()->with('good', 'You have been successfully subscribed to the newsletter.');
        } else {
            return Redirect::back()->with('bad', 'There was an error, or your email is invalid');
        }

    }
}
