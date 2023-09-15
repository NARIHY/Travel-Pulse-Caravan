<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\DNSCheckValidation;
use Egulias\EmailValidator\Validation\MultipleValidationWithAnd;
use Egulias\EmailValidator\Validation\RFCValidation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{

    /**
     * TO DO when user send contact
     * @param \App\Http\Requests\ContactRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    /*
    public function store(ContactRequest $request): RedirectResponse
    {
        try {
            //get all of information validated
            $data = $request->validated();
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
                // The email address is valid
                // Create an instance of the contact model with the validated data
                $contact = Contact::create($data);
                return redirect()->route('Public.home')->with('success', 'Merci, de nous avoir contacter');
            } else {
                // The email address is not valid
                return redirect()->route('Public.home')->with('Oups', 'Votre email n\'existe pas ou n\'est pas valide');
            }
        } catch (\Exception $e) {
            return redirect()->route('Public.home')->with('Oups', 'il y a eu une erreur lors de l\'envoie du message');
        }

    }
*/
    /**
     * listing contact send by users
     * @return \Illuminate\View\View
     */
    public function listing():View
    {
        $contact = Contact::orderBy('created_at', 'desc')
                                ->paginate(15);
        return view($this->viewPath().'index', [
            'contact' => $contact
        ]);
    }

    /**
     * For user interface
     * @return \Illuminate\View\View
     */
    /*
    public function interface(): View
    {
        return view('public.contact.index');
    }*/
    /**
     * For stock information given by users interface
     * @param ContactRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    /*
    public function intefaceSave(ContactRequest $request): RedirectResponse
    {
        try {
            //get all of information validated
            $data = $request->validated();
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
                // The email address is valid
                // Create an instance of the contact model with the validated data
                $contact = Contact::create($data);
                return redirect()->route('Public.Contact.contacts')->with('success', 'Merci, de nous avoir contacter');
            } else {
                // The email address is not valid
                return redirect()->route('Public.Contact.contacts')->with('Oups', 'Votre email n\'existe pas ou n\'est pas valide');
            }
        } catch (\Exception $e) {
            return redirect()->route('Public.Contact.contacts')->with('Oups', 'il y a eu une erreur lors de l\'envoie du message');
        }
    }
*/
    /**
     * View of one information
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function view(string $id): View
    {
        $contact = Contact::findOrFail($id);
        return view($this->viewPath().'view.view', [
            'contact' => $contact
        ]);
    }
    /**
     * needed to admin view
     * @return string
     */
    private function viewPath():string
    {
        $view = "admin.contact.";
        return $view;
    }

}
