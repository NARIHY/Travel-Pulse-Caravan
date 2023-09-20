<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MessageController extends Controller
{
    /**
     * List all user message
     * @return \Illuminate\View\View
     */
    public function allMessage(): View
    {
        // get user connected
        $user = Auth::user();
        $userId = $user->id;
        $participantId = Participant::where(function ($query) use ($userId) {
            $query->where('expediteur', $userId)
                ->orWhere('destinataire', $userId);
        })
        ->orderBy('created_at', 'desc')

        ->paginate(15);
        return view($this->viewPath().'allMessage', [
            'participantId' => $participantId,
            'user' => $user
        ]);
    }

    /**
     * Get participant Id -> search id of recipient and id of the sender
     * Differency recipient and id of the sender in different stylesheet
     * get their message in the entity message
     * this is an Iframe not a page
     * @param string $participant //id of participant
     * @return View
     */
    public function discutionOneOne(string $participant): View
    {
        $user = Auth::user();
        $userId = $user->id;
        $message = Message::orderBy('id', 'asc')
                                ->where('participant', $participant)
                                ->get();
        // Récupérer les participants
        $participants = Participant::where(function ($query) use ($userId) {
            $query->where('expediteur', $userId)
                ->orWhere('destinataire', $userId);
        })
        ->where('id', $participant)
        ->get(); // Utilisez get() pour récupérer les résultats
        $diffExpeditorUserId = null; // Initialisez à null
        $diffSenderUserId = null;
        foreach ($participants as $participant) {
            if ($participant->expediteur != $user->id) {
                $diffExpeditorUserId = $participant->expediteur;
                break; // Sortez de la boucle dès que l'ID est trouvé
            }

            if ($participant->destinataire != $user->id) {
                $diffSenderUserId = $participant->destinataire;
                break; // Sortez de la boucle dès que l'ID est trouvé
            }
        }
        $diffUserSender = null;
        $diffUserExpeditor = null;
        //initialise user sender of expeditor
        if (!empty($diffSenderUserId)) {
            $diffUserSender = User::findOrFail($diffSenderUserId);
        }
        if (!empty($diffExpeditorUserId)) {
            $diffUserExpeditor = User::findOrFail($diffExpeditorUserId);
        }

        return view($this->viewPath().'conversation.users', [
            'message' => $message,
            'user' => $user,
            'diffUserSender' => $diffUserSender,
            'diffUserExpeditor' => $diffUserExpeditor,
            'participant' => $participant
        ]);
    }

    /**
     *  get user connected
     * get participant identification
     * get different user connected
     * return this different users and users connected in view
     * @param string $participant
     * @return View
     */
    public function discution(string $participant): View
    {
        $user = Auth::user();
        $userId = $user->id;

        // Récupérer les participants
        $participants = Participant::where(function ($query) use ($userId) {
            $query->where('expediteur', $userId)
                ->orWhere('destinataire', $userId);
        })
        ->where('id', $participant)
        ->get(); // Utilisez get() pour récupérer les résultats
        $diffUserId = null; // Initialisez à null
        foreach ($participants as $participant) {
            if ($participant->expediteur != $user->id) {
                $diffUserId = $participant->expediteur;
                break; // Sortez de la boucle dès que l'ID est trouvé
            }

            if ($participant->destinataire != $user->id) {
                $diffUserId = $participant->destinataire;
                break; // Sortez de la boucle dès que l'ID est trouvé
            }
        }

        $diffUser = User::findOrFail($diffUserId);
        return view($this->viewPath().'conversation.message', [
            'user' => $user,
            'diffUser' => $diffUser,
            'participant' => $participant
        ]);
    }

    //post discution
    public function send(string $participant, MessageRequest $request): RedirectResponse
    {

        $message = Message::create($request->validated());
        $user = Auth::user();
        $part = Participant::findOrFail($participant);
        $differentUser = null;
        if ($user->id != $part->destinataire) {
            $differentUser = $part->destinataire;
        }
        if ($user->id != $part->expediteur) {
            $differentUser = $part->destinataire;
        }
        $data = [
            'participant' => $participant,
            'expediteur' => $user->id,
            'destinataire' => $differentUser

        ];
        $message->update($data);
        return redirect()->route($this->routes().'discution',['participant' => $participant]);
    }


    /**
     * ViewPath Message directory
     * @return string
     */
    private function viewPath(): string
    {
        $view = "admin.message.";
        return $view;
    }

    /**
     * Routes Message directory
     * @return string
     */
    private function routes(): string
    {
        $routes = "Admin.Message.";
        return $routes;
    }
}
