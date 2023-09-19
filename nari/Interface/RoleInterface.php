<?php
namespace Nari\Interface;
use Illuminate\Http\RedirectResponse;

interface RoleInterface
{

    /**
     * get only the role of administrator
     * @return bool
     */
    public function roles(): bool;

    /**
     * verify if user has acces to go to the dashboard
     * @return RedirectResponse | null
     */
    public function redirect(): RedirectResponse | null;

    /**
     * its the same to the redirect method but it used on compte management
     * @return RedirectResponse | null
     */
    public function onlyAdmin(): RedirectResponse | null;
}
