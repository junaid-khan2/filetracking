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

                $LastFileNumber = File::where('created_section', Auth::user()->section)->latest()->first() ?? null ;

                $data['created'] = File::where('created_section', Auth::user()->section)->count() ?? 0;

                $data['outBoundFile'] = File::where('file_type','File')->whereNot('current_section',Auth::user()->section)->where('created_section', Auth::user()->section)->count() ?? 0;

                $data['outBoundLetter'] = File::whereIn('file_type',['Letter','Reply','Reminder'])->whereNot('current_section',Auth::user()->section)->where('created_section', Auth::user()->section)->count() ?? 0;

                $data['disposed'] = File::where('current_section', Auth::user()->section)->where('status', 'Dispost')->count();

                $data['inprocess'] = File::where('current_section', Auth::user()->section)->where('status', 'In Process')->whereDoesntHave('files')->count();

                $data['intransit'] = File::where('current_section',Auth::user()->section)->where('status','In Transit')->whereDoesntHave('files')->count();



                $notifications =  File::whereDoesntHave('files')->where('current_section',Auth::user()->section)->where('status','In Transit')->latest()->get();

                

            }else{

                $data['created'] = 0;

                $data['disposed'] = 0;

                $data['inprocess'] = 0;

                $data['intransit'] = 0;

                $notifications = null;
                $LastFileNumber = null;

            }



            $view->with('fileCount', $data)->with('notifications',$notifications)
            ->with('lastCreatedFile',$LastFileNumber);

        });

    }

}

