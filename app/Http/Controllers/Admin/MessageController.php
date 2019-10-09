<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function contacts(){
        return view('template.contacts', [
            'headers' => $this->getContactHeaders(),
            'currentCategory' => 0,
        ]);
    }

    public function messages() {
        $items = Feedback::all()->sortByDesc('created_at');
        return view('admin.feedback.messages', [
            'items' => $items,
            'headers' => $this->getFeedbackHeaders(),
            'currentCategory' => 0,
        ]);
    }

    public function feedback(Request $request) {
        $this->validate($request, [
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
        return view('admin.feedback.read', [
            'headers' => $this->getFeedbackHeaders(),
            'currentCategory' => 0,
            'item' => $item
        ])->withTitle('Read Message');
    }

    public function messageDel(Feedback $item) {
        $item->delete();
        return redirect('admin/messages');
    }

    // Preparing headers for Main-Page
    private function getContactHeaders()
    {
        return [
            'pageTitle' => 'Контакты | Связь с нами | ' . config('app.name', 'Lexis'),
            'url' => asset('/contacts'),
            'title' => 'Контакты Vegans Freedom',
            'description' => 'Форма связи с командой проекта '  . config('app.name', 'Lexis'),
            'image' => asset('img/vegans.jpg')
        ];
    }

    private function getFeedbackHeaders()
    {
        return [
            'pageTitle' => 'Входящие Сообщения | Messages | ' . config('app.name', 'Lexis'),
            'url' => asset('/admin/feedback'),
            'title' => 'Сообщения',
            'description' => 'Сообщения от пользователей сайта ' . config('app.name', 'Lexis'),
            'image' => asset('img/vegans.jpg')
        ];
    }
}
