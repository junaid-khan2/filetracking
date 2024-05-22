<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\FileLog;
use App\Models\File;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
           
            if ($user = Auth::user()) {
                $data['created'] = FileLog::where('created_by', $user->id)->count() ?? 0;
                $data['disposed'] = File::where('current_section', $user->id)->where('status', 'Dispost')->count();
                $data['inprocess'] = File::where('current_section', $user->id)->where('status', 'In Process')->count();
                $data['intransit'] = File::where('current_section', $user->section)->where('status', 'In Transit')->count();
            }else{
                $data['created'] = 0;
                $data['disposed'] = 0;
                $data['inprocess'] = 0;
                $data['intransit'] = 0;
            }

            $view->with('fileCount', $data);
        });
    }
}
