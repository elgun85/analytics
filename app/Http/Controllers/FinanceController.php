<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Pest\Laravel\get;

class FinanceController extends Controller
{
    public function dmc(Request $request)
    {
// Maksimum icra müddətini artırır
        ini_set('max_execution_time', 900);

        // Sorğu parametrlərini əldə edir
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

        if ($month || $year)
            {
                // Əsas və əlavə cədvəllərin birləşdirilməsi
                $otherData = DB::table('e_flkartxes as other')
                    ->join('e_flkarts as main', function ($join) {
                        $join->on('other.notel', '=', 'main.notel')
                            ->on('other.ay', '=', 'main.ay')
                            ->on('other.il', '=', 'main.il');
                    })
                    ->leftJoin('e_lsqurums as company', function ($join) {
                        $join->on('main.KODQURUM', '=', 'company.KODQURUM')
                            ->on('main.ay', '=', 'company.ay')
                            ->on('main.il', '=', 'company.il');
                    })
                    ->leftJoin('e_lstarifs as tarif', function ($join) {
                        $join->on('other.KODTARIF', '=', 'tarif.KODTARIF')
                            ->on('other.ay', '=', 'tarif.ay')
                            ->on('other.il', '=', 'tarif.il');
                    })
                    ->select(
                        'main.notel',
                        'main.KODQURUM',
                        'main.ABONENT',
                        'other.KODTARIF',
                        'other.SUMMA',
                        'company.KATEQOR',
                        'tarif.KODISH'
                    );

                $otherDatas = DB::table(DB::raw("({$otherData->toSql()}) as E1"));
               // return $E1->take(10)->get();

                $mainData = DB::table('e_flkarts  as main')
                    ->leftJoin('e_lsqurums as company',
                        function ($join) {
                            $join->on('main.KODQURUM', '=', 'company.KODQURUM')
                                ->on('main.ay', '=', 'company.ay')
                                ->on('main.il', '=', 'company.il');
                        })
                    ->leftJoin('e_lstarifs as tarif',
                        function ($join) {
                            $join->on('main.kodtarif', '=', 'tarif.kodtarif')
                                ->on('main.ay', '=', 'tarif.ay')
                                ->on('main.ay', '=', 'tarif.ay');
                        }
                    )
                    ->select(
                        'notel',
                        'main.KODQURUM',
                        'ABONENT',
                        'main.KODTARIF',
                        'main.SUMMA0 as SUMMA',
                        'KATEQOR',
                        'KODISH'
                    )
                    ->unionAll($otherDatas);
                $dataJoin = DB::table(DB::raw("({$mainData->toSql()}) as T1"));
            //return    $dataJoin->take(10)->get();


                $dataCategory = $dataJoin
                    ->select('T1.*',
                        $dataJoin->raw(
                            '
                        CASE
    		WHEN T1.abonent IN (1, 8) THEN "MENZIL"
    		ELSE "IDERE"
    		END AS "categoriya",

                CASE
 		   	WHEN T1.kodtarif IN (707,708,721,722,723) AND T1.KODISH IN (1)                                       THEN "1.1 GPON"
 		    WHEN T1.kodtarif IN (1,2,7,10,21,111,349)  AND T1.KODISH IN (1)                                           THEN "1.2 Mis"

    		WHEN T1.kodtarif IN (324,325,326,328,329) AND T1.KODISH IN (10)                                                THEN "4.1.1 Ethernet"
    		WHEN T1.kodtarif IN (543,546)    AND T1.KODISH IN (1)                                                  THEN "4.1.2 ISP-lərdən"
    		WHEN T1.kodtarif IN (39,46,48,51,53,54,58,59,60,321)   AND T1.KODISH IN (1)                                THEN "4.1.3 Rəqəmsal kanallar"

            WHEN T1.kodtarif IN (410,411)   AND T1.KODISH IN (9)                                                     THEN "4.2.1 ATS-lərdə qur.avad."

            WHEN T1.kodtarif IN (368,369)        AND T1.KODISH IN (3)                                            THEN "4.3.1 Fiber-optik lifdən istifadə"
    		WHEN T1.kodtarif IN (391,392,396,397,398,399,407)    AND T1.KODISH IN (7)                                THEN "4.3.2 Kabel kan.icare"
    		WHEN T1.kodtarif IN (929,924)        AND T1.KODISH IN (4)                                               THEN "4.3.3 KTX"
    		WHEN T1.kodtarif IN (31,32,93,94,96,97)    AND T1.KODISH IN (1)                                       THEN "4.3.4 BRX-dən ist.haqqı"

    		WHEN T1.kodtarif IN (272,273,274,275,276,277,278,279,281,282,283,285,286,293,295) AND T1.KODISH IN (1)  THEN "5.1.2 Servis haqqı"
    		WHEN T1.kodtarif IN (4,6,36,49,61,235,907,920,925,926,928)  AND T1.KODISH IN (1)                         THEN "5.1.5 Mini ATS,3 rəqəmli pre.,NGN və s "
    		WHEN T1.kodtarif IN (8)       AND T1.KODISH IN (1)                                                    THEN "5.1.6 Taksafon  dan."
    		WHEN T1.kodtarif IN (289)     AND T1.KODISH IN (1)                                                    THEN "5.1.7 Texniki xidmət"

    		WHEN T1.kodtarif IN (927,930,931)       AND T1.KODISH IN (9)                                          THEN "6.2 Elektrik enerjisi"

    		ELSE          "basqa"
   		END AS "xidmetin_novu"
                '
                        )
                    );
                $dataCategories = DB::table(DB::raw("({$dataCategory->toSql()}) as T2"));

                //return$dataCategories->take(10)->get();

                $dataService = $dataCategories->select('T2.*',
                    DB::raw('COALESCE( T2.xidmetin_novu," ") as xidmetin_novu'),
                    $dataCategories->raw(
                        '
            CASE
   		WHEN T2.xidmetin_novu = "1.1 GPON"
   		  or T2.xidmetin_novu = "1.2 Mis"
   		    THEN    "1.0 Telefon xidmətləri"

   		WHEN T2.xidmetin_novu = "4.1.1 Ethernet"
   		  or T2.xidmetin_novu = "4.1.2 ISP-lərdən"
   		  or T2.xidmetin_novu = "4.1.3 Rəqəmsal kanallar"
   		    THEN    "4.1 İcarə haqqı (Portların  icarəsi)"

   		WHEN T2.xidmetin_novu = "4.2.1 ATS-lərdə qur.avad."
   		    THEN    "4.2 İcarə haqqı (Avadanlıqların icarəsi)"

   		WHEN T2.xidmetin_novu = "4.3.1 Fiber-optik lifdən istifadə"
   		  or T2.xidmetin_novu = "4.3.2 Kabel kan.icare"
   		  or T2.xidmetin_novu = "4.3.3 KTX"
   		  or T2.xidmetin_novu = "4.3.4 BRX-dən ist.haqqı"
   		    THEN    "4.3 İcarə haqqı (Kabellərin  icarəsi)"

   		WHEN T2.xidmetin_novu = "5.1.2 Servis haqqı"
   		  or T2.xidmetin_novu = "5.1.5 Mini ATS,3 rəqəmli pre.,NGN və s "
   		  or T2.xidmetin_novu = "5.1.6 Taksafon  dan."
   		  or T2.xidmetin_novu = "5.1.7 Texniki xidmət"
   		    THEN    "5. Servis (ƏDX)"

   		    WHEN T2.xidmetin_novu = "6.2 Elektrik enerjisi"
   		    THEN    "6. Digər"

   	 		ELSE "Sair xidmət başlıq"
   		END AS "Başlıq",

    SUM( CASE WHEN T2.categoriya = "MENZIL" THEN 1 ELSE 0 END ) as menzil_say,
    SUM( CASE WHEN T2.categoriya = "MENZIL" THEN T2.summa ELSE 0 END) as menzil_summa,

    SUM( CASE WHEN T2.categoriya = "IDERE" THEN 1 ELSE 0 END ) as idere_say,
    SUM( CASE WHEN T2.categoriya = "IDERE" AND T2.kateqor IN (21,31,71,23,33,73) THEN T2.summa ELSE 0 END) as idere_edv,
    SUM( CASE WHEN T2.categoriya = "IDERE" THEN T2.summa ELSE 0 END) as idere_summa,

    COUNT(*) as cemi_say,
    SUM(T2.summa) as cemi_hesab
                '
                    ));

                $resultsPhone = $dataService
                    ->whereIn('abonent', array(1, 2))
                    ->whereNotIn('KODISH', [0, 5, 6, 8])
                    ->groupBy('Başlıq')
                    ->groupBy(DB::raw('xidmetin_novu WITH ROLLUP'))
                    ->get();


                //SEnedlesme

                $dataPay = DB::table('e_banks as pay')
                    ->leftJoin('e_lsqurums as Ls',
                        function ($join) {
                            $join->on('pay.kodqurum', '=', 'Ls.kodqurum')
                                ->on('pay.ay', '=', 'Ls.ay')
                                ->on('pay.il', '=', 'Ls.il');
                        })
                    ->select('pay.notel', 'pay.kodqurum', 'pay.kodxidmet', 'pay.summa', 'Ls.kateqor', 'Ls.kodmhm', 'pay.ay', 'pay.il');
                $dataPay1 = DB::table(DB::raw("({$dataPay->toSql()}) as Ts1"));
                $dataPay1 = $dataPay1->select('Ts1.*',
                    $dataPay1->raw('
                CASE
             		WHEN Ts1.kodqurum = 0 THEN "MENZIL"
             		ELSE "IDERE"
             		END AS "categoriya",

	            CASE
 	         	   	WHEN Ts1.kodxidmet IN (101,102,103,104,105,107)                                         THEN "1. Telefon çəkilişi"
 	         	   	WHEN Ts1.kodxidmet IN (382,581,582,584,602,378)                                                 THEN "3. Avadanlıq satışı(GPON,LTE və s.)"
 	         	   	WHEN Ts1.kodxidmet IN (5,121,123,131,135,136,151,171,262,299,342,345,521,533,542,545
 	         	   	)                                             THEN "2. Bərpa,A-Ada,nömrə dəy. və s."
 	         	   	WHEN Ts1.kodxidmet IN (109,372,373,374)                                         THEN "4. Smeta,Kabelləşmə və s."



            		ELSE "Digər"
   	        	END AS "xidmetin_novu"
   	        	'));
                $dataPay2 = DB::table(DB::raw("({$dataPay1->toSql()}) as Ts2"));

                $payment = $dataPay2
                    ->select('Ts2.xidmetin_novu',
                        DB::raw('COALESCE( Ts2.xidmetin_novu,"Cəmi") as xidmetin_novu'),
                        $dataPay2->raw('

                      SUM( CASE WHEN Ts2.categoriya = "MENZIL" THEN 1 ELSE 0 END ) as menzil_say,
                      SUM( CASE WHEN Ts2.categoriya = "MENZIL" THEN Ts2.summa ELSE 0 END) as menzil_summa,

                      SUM( CASE WHEN Ts2.categoriya = "IDERE" THEN 1 ELSE 0 END ) as idere_say,
                      SUM( CASE WHEN Ts2.categoriya = "IDERE" AND Ts2.kateqor IN (21,31,71,23,33,73) THEN Ts2.summa ELSE 0 END) as idere_edv,
                      SUM( CASE WHEN Ts2.categoriya = "IDERE" THEN Ts2.summa ELSE 0 END) as idere_summa,

                      COUNT(*) as cemi_say,
                      SUM(Ts2.summa) as cemi_hesab
                       '));
                $resultsPay = $payment
                    ->where('ay', $month)
                    ->where('il', $year)
                    ->where('xidmetin_novu', '!=', 'Digər')
                    ->groupBy(DB::raw('Ts2.xidmetin_novu WITH ROLLUP'))
                    ->take(150)
                    ->get();


                return view('Finance.dmc', compact('resultsPhone', 'resultsPay', 'months', 'years'));

            } else{
            return view('Finance.dmc',compact('months','years'));
        }

    }
        public function dmfh()
    {
        return 'dmc';
        return view('Finance.dmfh');
    }
        public function edvs()
    {
        return 'dmc';
        return view('Finance.edvs');
    }
        public function edv()
    {
        return 'dmc';
        return view('Finance.edv');
    }


}
