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
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

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
                $user->update($request->validated());

                $picture = $request->validated('picture');

                if (empty($picture)) {
                    $picture = $user->picture;
                } else {
                    //image 1
                    if (!empty($users->picture)) {

                        Storage::disk('public')->delete($users->picture);
                    }
                    $data['picture'] = $picture->store('users', 'public');
                    $user->update($data);
                }

                return redirect()->route($this->routes() . 'edit')->with('success', 'Modification réussie');
            } else {
                return redirect()->route($this->routes() . 'edit')->with('error', 'L\'email que vous avez entré n\'existe pas ou est invalide');
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
