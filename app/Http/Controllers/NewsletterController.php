<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsletterRequest;
use App\Mail\NewsLetterMail;
use App\Models\Newsletter;
use App\Models\Subscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class NewsletterController extends Controller
{
    /**
     * Return listing newsletter who are not send
     * @return \Illuminate\View\View
     */
    public function listing(): View
    {
        $newsletter = Newsletter::orderBy('created_at', 'desc')
                                    ->where('info', 0)
                                    ->paginate(15);
        return view($this->viewPath().'index', [
            'newsletter' => $newsletter
        ]);
    }

    /**
     * Create newsletter
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view($this->viewPath().'action.random');
    }

    /**
     * Store the newsletter given
     * @param \App\Http\Requests\NewsletterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewsletterRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $newsletter = Newsletter::create($data);
            $newsletter->update(['info' => 0]);
            return redirect()->route($this->routes().'listing')->with('success', 'successfully added letter');
        } catch (\Exception $e) {
            return redirect()->route($this->routes().'create')->with('error', 'Oops, there was a mistake');
        }
    }

    /**
     * Edition view of one newsletter already posted
     * @param string $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(string $id)
    {
        $newsletter = Newsletter::findOrFail($id);
        return view($this->viewPath().'action.random', [
            'newsletter' => $newsletter
        ]);
    }

    /**
     * Update letter
     * @param string $id
     * @param \App\Http\Requests\NewsletterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(string $id, NewsletterRequest $request) : RedirectResponse
    {
        try {
            $data = $request->validated();
            $newsletter = Newsletter::findOrFail($id);
            $newsletter->update($data);
            return redirect()->route($this->routes().'edit', ['id' => $newsletter->id])->with('success', 'modification of letter successful');
        } catch (\Exception $e) {
            return redirect()->route($this->routes().'edit', ['id' => $newsletter->id])->with('error', 'Oops, there was a mistake');
        }
    }

    /**
     * To do when user send newletter
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendEmail(string $id): RedirectResponse
    {
        $notification = new NewsLetterMail($id);
        //get all subscriber
        $subscriber = Subscriber::get();
        //send email to all of subscriber
        foreach ($subscriber as $subscribers) {
            Mail::to($subscribers->email)->send($notification);
        }
        $newsletter = Newsletter::findOrFail($id);
        //update news letter to send
        $newsletter->update(['info' => '1']);
        return redirect()->route($this->routes().'listing')->with('success', 'send emails to subscribers successfully');
    }
    /**
     * return view path of newsletter
     * @return string
     */
    private function viewPath(): string
    {
        $view = "admin.page.newsletter.";
        return $view;
    }
    /**
     * Route path
     * @return string
     */
    private function routes(): string
    {
        $routes = "Admin.Newsletter.";
        return $routes;
    }
}
