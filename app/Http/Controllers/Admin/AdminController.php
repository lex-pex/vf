<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\DailyVisit;
use App\Models\Feedback;
use App\Models\User;
use App\Models\Category;
use App\Models\Visit;

class AdminController extends Controller
{

    public function panel() {
        $category_id = 0;
        $totalMessages = Feedback::count();
        $newMessages = Feedback::where('status', 0)->count();
        $weeksMap = $this->getWeeksMap();
        $totalVisits = Visit::sum('amount');
        return view('admin.panel', [
            'totalMessages' => $totalMessages,
            'newMessages' => $newMessages,
            'totalVisits' => $totalVisits,
            'headers' => $this->getPanelHeaders(),
            'currentCategory' => $category_id,
            'weeksMap' => $weeksMap,
        ]);
    }

    /**
     * Posts managing list
     */
    public function posts() {
        $blogPosts = BlogPost::getAllPosts();
        $categories = Category::getCategories();
        $adminCategories = Category::getAdminCategories();
        $category_id = 0;
        return view('admin.posts', [
            'headers' => $this->adminPostHeaders(),
            'categories' => $categories,
            'currentCategory' => $category_id,
            'blogPosts' => $blogPosts,
            'adminCategories' => $adminCategories,
        ]);
    }

    /**
     * Users' profiles list
     */
    public function usersAdmin() {
        $users = User::getUsersAdmin();
        $categories = Category::getCategories();
        $adminCategories = Category::getAdminCategories();
        $category_id = 0;
        return view('admin.users.users', [
            'headers' => $this->adminUsersHeaders(),
            'categories' => $categories,
            'currentCategory' => $category_id,
            'users' => $users,
            'adminCategories' => $adminCategories,
        ]);
    }

    /**
     * Spread the Daily Visits table into the array of Months
     */
    public function getCalendar() {
        $calendar = array();
        $dailyVisits = DailyVisit::all()->sortBy('date');
        foreach($dailyVisits as $visits) {
            $str = $visits->date;
            $time = strtotime($str);
            $month = date('M', $time) . ' ' . date('Y', $time);
            $day = date('j', $time);
            $calendar[$month][$day] = $visits;
        }
        return $calendar;
    }

    /**
     * Divide the Months Array into the Weeks Array
     */
    private function getWeeksMap() {
        $cal = $this->getCalendar();
        $weeks = [];
        foreach ($cal as $monthName => $month) {
            $w = 0;
            $prevSunday = '';
            foreach($month as $num => $visits) {
                $str = $visits->date;
                $time = strtotime($str);
                $wd = date('w', $time);
                $d = date('j', $time);
                $thisSunday = $d - $wd;
                if(is_numeric($prevSunday)) {
                    if($thisSunday > $prevSunday) $w ++;
                }
                $weeks[$monthName][$w][$wd] = $visits;
                $prevSunday = $thisSunday;
            }
        }
        return $weeks;
    }

    /**
     * Pages Headers 
     */
    private function getPanelHeaders(){
        return [
            'pageTitle' => 'Admin DashBoard | VF',
            'url' => '/admin/',
            'title' => 'Admin DashBoard',
            'description' => 'Admin Dashboard | Vegans Freedom | Admin',
            'image' => '/img/vegans.jpg'];
    }

    private function adminPostHeaders()
    {
        return [
            'pageTitle' => 'Список Публикаций VegansFreedom',
            'url' => '/admin/posts/',
            'title' => 'Список Публикаций',
            'description' => 'Vegans Freedom Admin',
            'image' => '/img/vegans.jpg',
        ];
    }

    private function adminUsersHeaders()
    {
        return [
            'pageTitle' => 'Пользователи | VegansFreedom',
            'url' => '/admin/users/',
            'title' => 'Пользователи | Админ',
            'description' => 'Пользователи Vegans Freedom | Admin',
            'image' => '/img/vegans.jpg',
        ];
    }
}
