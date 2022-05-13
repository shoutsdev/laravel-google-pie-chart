<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        try {
            $users = User::selectRaw('DATE(created_at) as date,COUNT(*) as count')->groupBy('date')->get();

            $result[] = ['Date', 'ToTal User'];
            foreach ($users as $user) {
                $result[] = [$user->date,$user->count];
            }
            $data = [
                'users' => json_encode($result),
            ];

            return view('chart', $data);
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
