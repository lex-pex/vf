<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class MessageController extends Controller
{

    public function contacts() {
        return view('pages.contacts', [
            'headers' => $this->getContactHeaders(),
            'currentCategory' => 0,
        ]);
    }

    public function messages() {
        $items = Feedback::all()->sortByDesc('created_at');
        return view('template.admin.feedback.messages', [
            'items' => $items,
            'headers' => $this->getFeedbackHeaders(),
            'currentCategory' => 0,
        ]);
    }

    public function feedback(Request $request) {
        $this->validate($request, [
            'captcha' => 'required|in:5',
            'name' => 'required|min:2|max:100',
            'email' => 'email',
            'text' => 'required|min:3|max:510',
        ]);
        $data = $request->except('_token');
        $feedback = new Feedback();
        $feedback->fill($data);
        $feedback->save();
        return redirect()->back()->with('messageSent', true);
    }

    public function readFeedback($id){
        $item = Feedback::find($id);
        $item->status = 1;
        $item->save();
        return view('template.admin.feedback.read', [
            'headers' => $this->getFeedbackHeaders(),
            'currentCategory' => 0,
            'item' => $item
        ])->withTitle('Read Message');
    }

    public function messageDel(Feedback $item) {
        $item->delete();
        return redirect('admin/feedback');
    }

    // Preparing headers for Main-Page
    private function getContactHeaders()
    {
        return [
            'pageTitle' => 'Vegans Freedom | Контакты | Связь с нами',
            'url' => asset('/contacts'),
            'title' => 'Контакты Vegans Freedom',
            'description' => "Форма связи с командой Vegans Freedom",
            'image' => asset('img/vegans.jpg')
        ];
    }

    private function getFeedbackHeaders()
    {
        return [
            'pageTitle' => 'Vegans Freedom | Messages',
            'url' => asset('/admin/feedback'),
            'title' => 'Админ Сообщения Vegans Freedom',
            'description' => "Сообщения от пользователей",
            'image' => asset('img/vegans.jpg')
        ];
    }
}













