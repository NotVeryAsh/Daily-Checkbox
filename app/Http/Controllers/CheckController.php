<?php

namespace App\Http\Controllers;

use App\Models\Check;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CheckController extends Controller
{
    public function index(Request $request)
    {
        $check = Check::query()
            ->where('ip', $request->ip())
            ->first();

        $hideCheck = $check && Carbon::parse($check->updated_at) > Carbon::now()->subDay();
        $checks = Check::query()->orderBy('count', 'desc')->limit(5)->get();

        return view('home', [
            'hideCheck' => $hideCheck,
            'checks' => $checks,
            'name' => $check?->name
        ]);
    }

    public function check(Request $request)
    {
        $ip = $request->ip();
        $name = $request->input('name');
        if(empty($name)) {
            return redirect()->route('index');
        }

        $check = Check::query()
            ->where('ip', $ip)->first();

        if($check && Carbon::parse($check->updated_at) > Carbon::now()->subDay()) {
            return redirect()->route('index');
        }

        if(!$check) {
            $check = Check::query()
                ->create([
                    'ip' => $ip,
                    'name' => $name
                ]);
        }

        $check->update([
            'count' => $check->count +1,
            'name' => $name
        ]);

        return redirect()->route('index');
    }
}
