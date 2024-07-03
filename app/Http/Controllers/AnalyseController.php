<?php

namespace App\Http\Controllers;

use App\Models\tarif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyseController extends Controller
{
    public function ixa(Request $request)
    {
        ini_set('max_execution_time', 900);

        $category = $request->category;
        $novu = $request->novu;
        $esas = $request->esas;
        $elave = $request->elave;
        $abonent = $request->abonent;
        $abonent2 = $request->abonent2;
        $internet = $request->internet;

        // Tarif məlumatlarını gətir
        $tarifQuery = tarif::orderBy('kod', 'ASC');
        if ($category) {
            $tarifQuery->where('category', $category);
        }
        if ($novu) {
            $tarifQuery->where('novu', $novu);
        }
        $inter_tarif = $tarifQuery->get();


        $results = DB::table('e_flkarts as main')
            ->leftJoin('e_flkartxes as extra', function ($join) {
                $join->on('main.notel', '=', 'extra.notel')
                    ->whereNotBetween('extra.KODTARIF', [5, 410]);
            })
            ->leftJoin('e_lstarifs as tariff', 'extra.KODTARIF', '=', 'tariff.KODTARIF')
            ->leftJoin('e_lstarifs as main_tariff', 'main.KODTARIF', '=', 'main_tariff.KODTARIF') // New join
            ->select(
                'main.notel',
                'main.ABONENT',
                'main.ABONENT2',
                'main.KODTARIF as main_tariff',
                'extra.KODTARIF as extra_tariff',
                'tariff.adtarif as extra_adtarif',
                'tariff.KODISH as extra_KODISH',
                'main_tariff.adtarif as main_adtarif', // New selection
                'main_tariff.KODISH as main_KODISH'   // New selection
            );


        if ($esas) {
            $results->where('main.KODTARIF', $esas);
        }
        if ($abonent) {
            $results->where('main.ABONENT', $abonent);
        }
        if ($abonent2) {
            $results->where('main.ABONENT2', $abonent2);
        }
        if ($elave) {
            $results->where('extra.KODTARIF', $elave);
        }
        if ($internet) {
            $results->whereIn('extra.KODTARIF', $internet);
        }


        $search = $results
            ->whereIn('main.ABONENT', [1, 2, 8])
            ->get();
        return view('Analyse.ixa', compact('inter_tarif', 'category', 'search'));
    }

    public function dp()
    {
        $data = DB::table('e_flkartxes as elave')
            ->leftJoin('e_lsqurums as qurum', 'elave.kodqurum', '=', 'qurum.kodqurum')
            ->select
            (
                DB::raw
                ('count(*) as say,
                                 COALESCE(elave.kodqurum, "cemi") as cem,
                                 MAX(elave.notel) as notel,
                                 MAX(elave.KODTARIF) as KODTARIF,
                                 elave.kodqurum,
                                 MAX(qurum.ADQURUM) as ADQURUM'
                )
            )
            ->where('elave.KODTARIF', 543)
            ->groupBy(DB::raw('elave.kodqurum WITH ROLLUP'))
            ->get();


        return view('Analyse.dp', compact('data'));
    }

    public function hm()
    {
        return view('Analyse.hm');
    }

    public function ml()
    {
        return view('Analyse.ml');
    }

    public function mld()
    {
        return view('Analyse.mld');
    }
}
