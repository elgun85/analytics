<?php

namespace App\Http\Controllers;

use App\Models\TelnetCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class HomeControlller extends Controller
{
    public function dashboard()
    {
        return  view('page.dashboard');
    }

    public function telnet()
    {

        $result = DB::select("
            SELECT
                (SELECT COUNT(*) FROM telnet_categories) as categoryTitleCount,
                (SELECT COUNT(*) FROM telnet_positions) as positionTitleCount,
                (SELECT COUNT(*) FROM telnet_personnels) as loginCount,
                (SELECT COUNT(*) FROM telnet_personnels WHERE status = 1) as statusCount1,
                (SELECT COUNT(*) FROM telnet_personnels WHERE status = 0) as statusCount0
        ");

        $statistics = $result[0];

       /* $statusCount1Percentage = $totalLoginCount > 0 ? ($statistics->statusCount1 / $totalLoginCount) * 100 : 0;
        $statusCount0Percentage = $totalLoginCount > 0 ? ($statistics->statusCount0 / $totalLoginCount) * 100 : 0;*/


        /*        return response()->json([
                    'categoryTitleCount' => $statistics->categoryTitleCount,
                    'positionTitleCount' => $statistics->positionTitleCount,
                    'loginCount' => $statistics->loginCount,
                    'statusCount1' => $statistics->statusCount1,
                    'statusCount0' => $statistics->statusCount0
                ]);*/
        return  view('page.telnet',compact('statistics'));
    }

    public function tarif()
    {
       return view('Page.tarif');
    }

    public function dataTable()
    {
        return view('Page.dataTable');
    }
    public function dataTable2(Request $request)
    {
        $year = $request->year;
        $month = $request->month;

        // Ayları qruplaşdır və sayını al
        $months = DB::table('e_flkarts as main')
            ->select('ay as month', DB::raw('count(*) as total'))
            ->groupBy('month')
            ->get();

        // İlləri qruplaşdır və sayını al
        $years = DB::table('e_flkarts as main')
            ->select('il as year', DB::raw('count(*) as total'))
            ->groupBy('year')
            ->get();
        return view('Page.dataTable2',compact('months','years'));
    }



}
