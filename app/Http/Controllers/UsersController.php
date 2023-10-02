<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersUpdateRequest;
use App\Models\User;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\DNSCheckValidation;
use Egulias\EmailValidator\Validation\MultipleValidationWithAnd;
use Egulias\EmailValidator\Validation\RFCValidation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\VerifyEmail;
class UsersController extends Controller
{
    //users Controller Admin
    /**
     * User profile view
     * @return \Illuminate\View\View
     */
    public function profile(): View
    {
        $user = Auth::user();
        return view($this->viewPath().'profil', [
            'user' => $user
        ]);
    }

    /**
     * Edition users view
     * @return \Illuminate\View\View
     */
    public function edit(): View
    {
        $user = Auth::user();

        return view($this->viewPath().'setting.account', [
            'user' => $user
        ]);
    }

    public function update(UsersUpdateRequest $request): RedirectResponse
    {
        try {
            $users = Auth::user();
            $user = User::findOrFail($users->id);
            //get user password enter by users
            $passwordEnterByUser = $request->input('password');
            //if passwordEnter by User is different to the user password, denied the request else, we continu the script
            if(Hash::check($passwordEnterByUser, $user->password)) {
                $email = $request->validated()['email'];
                // Create an instance of the email validator
                $validator = new EmailValidator();
                // Configure multiple validations to apply (RFCValidation and DNSCheckValidation)
                $multipleValidations = new MultipleValidationWithAnd([
                    new RFCValidation(),
                    new DNSCheckValidation()
                ]);
                // Check if the email address is valid using the configured validations
                if ($validator->isValid($email, $multipleValidations)) {
                    //verify if email enter by user != to user email
                    if ($request->input('email') !== $user->email) {
                        //return the email verification to null
                        $request->user()->email_verified_at = null;
                        //save the information
                        $request->user()->save();
                    }
                    //update users information
                    $user->update($request->validated());
                    //for picture modification
                    $picture = $request->validated('picture');
                    if (empty($picture)) {
                        $picture = $user->picture;
                    } else {
                        if (!empty($users->picture)) {
                            //deleting picture in storage to save space
                            Storage::disk('public')->delete($users->picture);
                        }
                        $data['picture'] = $picture->store('users', 'public');
                        $user->update($data);
                    }
                    return redirect()->route($this->routes() . 'edit')->with('success', 'Modification réussie');
                } else {
                    return redirect()->route($this->routes() . 'edit')->with('error', 'L\'email que vous avez entré n\'existe pas ou est invalide');
                }
            } else {
                return redirect()->route($this->routes() . 'edit')->with('error', 'le mots de passe que vous avez entrée ne correspond à aucun compte');
            }
        } catch (\Exception $e) {
            // Gérer les erreurs de validation ici (si nécessaire)
            return redirect()->route($this->routes() . 'edit')->with('error', 'Erreur de validation : ' . $e->getMessage());
        }
    }

    /**
     * View path
     * @return string
     */
    private function viewPath(): string
    {
        $view = "admin.users.";
        return $view;
    }

    /**
     * Routes path
     * @return string
     */
    private function routes(): string
    {
        $routes = "Admin.Utilisateur.";
        return $routes;
    }
}
