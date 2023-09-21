<?php
namespace Nari;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Nari\Interface\RoleInterface;

class Role implements RoleInterface
{
    public $user;

    private function userRoles(): string
    {
        $roles = $this->user->role;
        return $roles;
    }

    private function verify(): bool
    {
        if ($this->userRoles() == 1) {
            return true;
        }
        return false;
    }


    public function roles(): bool
    {

        //if user has member return true
        if ($this->userRoles() == 2) {
            return true;
        }
        return false;

    }

    public function redirect(): RedirectResponse | null
    {
        if($this->verify() === true) {
            return redirect()->route('Public.index');
        } else {
            return null;
        }
    }

    public function onlyAdmin(): RedirectResponse | null
    {
        if($this->roles() === true) {
            return redirect()->route('Admin.Compte.forbiden');
        } else {
            return null;
        }
    }

    /**
     * To construct our class
     * @param \App\Models\User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
