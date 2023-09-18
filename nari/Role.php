<?php
namespace Nari;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Nari\Interface\RoleInterface;

class Role implements RoleInterface
{
    public $user;

    public function verify(): bool
    {

        $roles = $this->user->role;
        //if user has member return true
        if ($roles === 1) {
            return true;
        } else {
            return false;
        }
    }
    public function roles(): bool
    {
        $roles = $this->user->role;
        //if user has member return true
        if ($roles !== 2) {
            return true;
        } else {
            return false;
        }
    }

    public function redirect(): RedirectResponse | null
    {
        if($this->verify() === true) {
            return redirect()->route('Pubic.index');
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
