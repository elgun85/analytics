<?php

namespace App\Http\Controllers;

use App\Models\mhm_hes;
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
                                 elave.notel as notel,
                                 elave.KODTARIF as KODTARIF,
                                 elave.kodqurum,
                                 qurum.ADQURUM as ADQURUM'
                )
            )
            ->where('elave.KODTARIF', 543)
            ->groupBy(DB::raw('elave.kodqurum WITH ROLLUP'))
            ->get();


        return view('Analyse.dp', compact('data'));
    }

    public function hm(Request $request)
    {
        $il = $request->il;
        $ay = $request->ay;

        $aylar = DB::table('e_flkarts as esas')
            ->select('ay', DB::raw('count(*) as total'))
            ->groupBy('ay')
            ->get();

        $iller = DB::table('e_flkarts as esas')
            ->select('il', DB::raw('count(*) as total'))
            ->groupBy('il')
            ->get();

        if ($ay || $il) {
            $E = DB::table('e_flkartxes as elave')
                ->join('e_flkarts as esas', 'elave.notel', '=', 'esas.notel')
                ->leftJoin('e_lsqurums as qurum', 'elave.KODQURUM', '=', 'qurum.KODQURUM')
                ->leftJoin('e_lstarifs as tarif', 'elave.KODTARIF', '=', 'tarif.KODTARIF')
                ->select(
                    'esas.notel',
                    'esas.ABONENT',
                    'elave.KODQURUM',
                    'elave.SUMMA as SUMMA',
                    'qurum.KODMHM',
                    'tarif.KODISH'
                );

            $E1 = DB::table(DB::raw("({$E->toSql()}) as E1"));

            $B = DB::table('e_flkarts as esas')
                ->leftJoin('e_lsqurums as qurum', 'esas.KODQURUM', '=', 'qurum.KODQURUM')
                ->leftJoin('e_lstarifs as tarif', 'esas.kodtarif', '=', 'tarif.kodtarif')
                ->select(
                    'notel',
                    'ABONENT',
                    'esas.KODQURUM',
                    'esas.SUMMA0 as SUMMA',
                    'KODMHM',
                    'KODISH'
                )
                ->unionAll($E1);

            $data = DB::table(DB::raw("({$B->toSql()}) as T1"))
                ->select('T1.*',
                    DB::raw('SUM(SUMMA) as cemi_hesablama'))
                ->whereIn('ABONENT', [1, 2])
                ->whereNotIn('KODISH', [0, 5, 6, 8])
                ->whereNotIn('SUMMA', [0])
                ->groupBy('notel')
                ->get();



            return view('Analyse.hm', compact('data', 'aylar', 'iller'));
        }

        return view('Analyse.hm', compact('aylar', 'iller'));
    }

    public function ml(Request $request)
    {
        $il = $request->il;
        $ay = $request->ay;

        $aylar=DB::table('e_flkarts as esas')
            -> select('ay', DB::raw('count(*) as total'))
            ->groupBy('ay')
            ->get();

        $iller=DB::table('e_flkarts as esas')
            -> select('il', DB::raw('count(*) as total'))
            ->groupBy('il')
            ->get();

        if ($ay or $il)
        {
            $E=DB::table('e_flkartxes as elave')
                ->join('e_flkarts  as esas','elave.notel', '=', 'esas.notel')
                ->leftJoin('e_lsqurums as qurum','elave.KODQURUM', '=', 'qurum.KODQURUM')
                ->leftJoin('e_lstarifs as tarif','elave.KODTARIF', '=', 'tarif.KODTARIF')
                ->select(

                    'esas.notel',
                    'esas.ABONENT',
                    'elave.SUMMA as SUMMA',
                    'tarif.KODISH'
                )
            ;
            $E1=DB::table(DB::raw("({$E->toSql()}) as E1"));

            $B=DB::table('e_flkarts  as esas')
                ->leftJoin('e_lsqurums as qurum','esas.KODQURUM','=','qurum.KODQURUM')
                ->leftJoin('e_lstarifs as tarif','esas.kodtarif','=','tarif.kodtarif')
                ->select(
                    'notel',
                    'ABONENT',
                    'esas.SUMMA0 as SUMMA',
                    'KODISH'
                )
                ->unionAll($E1);
            $T1=DB::table(DB::raw("({$B->toSql()}) as T1"));

            $T1=$T1->select('T1.*',$T1->raw('SUM(SUMMA) as lks_hesablama'));
            $A1=$T1
                ->whereIn('ABONENT',array(1,2))
                ->whereNotIn('KODISH',array(0,5,6,8))
                ->whereNotIn('SUMMA',[0])
                ->groupBy('notel')
                ->get();

            $lksArray=$A1
                ->keyBy('notel')
                ->toArray();

            $mhm=mhm_hes::
            select('notel','summa',DB::raw('SUM(summa) as mhm_hesablama'))
                ->groupBY('notel')
                ->get();


            $mhmArray=$mhm
                ->keyBy('notel')
                ->toArray();

            $lks=$A1;


            return view('Analyse.ml',compact('mhm','lksArray','aylar','iller','mhmArray','lks'));
        }else{
            return view('Analyse.ml',compact('aylar','iller'));
        }

    }

    public function mld(Request $request)
    {
        $il = $request->il;
        $ay = $request->ay;

        // Aylar üzrə qruplaşdırılmış məlumatları əldə edirik
        $aylar = DB::table('e_flkarts as esas')
            ->select('ay', DB::raw('count(*) as total'))
            ->groupBy('ay')
            ->get();

        // İllər üzrə qruplaşdırılmış məlumatları əldə edirik
        $iller = DB::table('e_flkarts as esas')
            ->select('il', DB::raw('count(*) as total'))
            ->groupBy('il')
            ->get();

        if ($ay || $il) {
            // E və B cədvəllərinin birləşdirilməsi
            $E = DB::table('e_flkartxes as elave')
                ->join('e_flkarts as esas', 'elave.notel', '=', 'esas.notel')
                ->leftJoin('e_lsqurums as qurum', 'esas.KODQURUM', '=', 'qurum.KODQURUM')
                ->leftJoin('e_lstarifs as tarif', 'elave.KODTARIF', '=', 'tarif.KODTARIF')
                ->select(
                    'esas.notel',
                    'esas.ABONENT',
                    'elave.KODTARIF',
                    'elave.SUMMA as SUMMA',
                    'tarif.KODISH',
                    'qurum.KODQURUM',
                    'qurum.KODMHM'
                );

            // B cədvəli ilə birlikdə yeni sorğu yaradılması
            $B = DB::table('e_flkarts as esas')
                ->leftJoin('e_lsqurums as qurum', 'esas.KODQURUM', '=', 'qurum.KODQURUM')
                ->leftJoin('e_lstarifs as tarif', 'esas.kodtarif', '=', 'tarif.kodtarif')
                ->select(
                    'notel',
                    'ABONENT',
                    'esas.KODTARIF',
                    'esas.SUMMA0 as SUMMA',
                    'KODISH',
                    'qurum.KODQURUM',
                    'KODMHM'
                )
                ->unionAll($E);

            // Bütün məlumatların toplanması və yeni T1 sorğusu yaradılması
            $T1 = DB::table(DB::raw("({$B->toSql()}) as T1"))
                ->select('T1.*', DB::raw('SUM(SUMMA) as lks_hesablama'));

            // A1 sorğusu üzərində filtr tətbiq edilməsi
            $A1 = $T1
                ->whereIn('ABONENT', [1, 2])
                ->whereNotIn('KODISH', [0, 5, 6, 8])
                ->whereNotIn('SUMMA', [0])
                ->whereNotIn('KODTARIF', [543]);

            // Məlumatları qruplaşdıraraq arraylara çevirmək
            $lksArray = $A1
                ->clone()
                ->groupBy('notel')
                ->get()
                ->keyBy('notel')
                ->toArray();

            $lksArrayQ = $A1
                ->clone()
                ->groupBy('KODQURUM')
                ->get()
                ->keyBy('KODMHM')
                ->toArray();

            // MHM hesabatlarının hazırlanması
            $mhmQuery = mhm_hes::groupBy('notel')
                ->whereNotIn('summa', [0]);

            $mhm_m = $mhmQuery
                ->clone()
                ->select('notel', 'summa', DB::raw('ROUND(SUM(summa), 2) as mhm_hesablama'))
                ->where('notel', '>=', 4370000)
                ->get();

            $mhm_q = $mhmQuery
                ->clone()  //Clone istifadəsi: Orijinal sorğuların dəyişməməsi üçün clone() metodu istifadə edildi.
                ->select('notel as KODMHM', 'summa', DB::raw('ROUND(SUM(summa), 2) as mhm_hesablama'))
                ->where('notel', '<', 4370000)
                ->get();

            // Nəticələri view-ə göndərmək
            return view('Analyse.mld', compact(
                'mhm_m', 'mhm_q',
                'lksArray', 'lksArrayQ',
                'aylar', 'iller'
            ));
        } else {
            // Aylar və illər üzrə məlumatları göndərmək
            return view('Analyse.mld', compact('aylar', 'iller'));
        }
    }
}
