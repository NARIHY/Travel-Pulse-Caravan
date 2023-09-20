<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParticipantRequest;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ParticipantController extends Controller
{
    /**
     * Create a new message of one users to one users
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        //user connected
        $user = Auth::user();
        $allUser = User::where('id', '!=', $user->id)
                            ->orderBy('created_at', 'desc')
                            ->pluck('id','name');

        return view($this->viewPath().'create.index',[
            'allUser' => $allUser
        ]);
    }

    /**
     * @param Participantrequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(ParticipantRequest $request): RedirectResponse
    {
        $expediteur = $request->validated('expediteur');
        $destinataire = $request->validated('destinataire');
        $verify = Participant::get();
        foreach($verify as $verif) {
            if ($verif->expediteur == $expediteur && $destinataire == $verif->destinataire) {
                return redirect()->route('Admin.Message.discution', ['participant' => $verif->id]);
            }
            if ($verif->expediteur == $destinataire && $expediteur  == $verif->destinataire) {
                return redirect()->route('Admin.Message.discution', ['participant' => $verif->id]);
            }
        }

        $data = $request->validated();
        $participant = Participant::create($data);
        return redirect()->route('Admin.Message.discution', ['participant' => $participant->id]);
    }

    private function viewPath(): string
    {
        $view = "admin.message.";
        return $view;
    }
}
