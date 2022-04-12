<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class TruckerPeriodExport implements FromView
{
    protected $period;
    protected $date_post;

    function __construct($period, $date_post)
    {
        $this->period = $period;
        $this->date_post = $date_post;
    }
    public function view(): View
    {
        // $datecut = explode(" - ", $this->date_export);
        // $datestart = date('Y-m-d', strtotime(str_replace('/', '-', $datecut[0])));
        // $dateend = date('Y-m-d', strtotime(str_replace('/', '-', $datecut[1])));
        $datestart = $this->period->periodStart;
        $dateend = $this->period->periodEnd;
        $datepost = date('Y-m-d', strtotime(str_replace('/', '-', $this->date_post)));
        // dd($datepost);
        // $sql = "SELECT
        // '1' AS NO,
        // '1800' as BUKRS,
        //  invoiceNo XBLNR,
        // 'KR' AS BLART,
        // CONCAT ( FORMAT ( CONVERT ( datetime, drivingStart ), 'yyyyMMdd' ), '_', FORMAT ( CONVERT ( datetime, drivingEnd ), 'yyyyMMdd') ) AS BKTXT,
        // FORMAT (truckerPayDate, 'dd.MM.yyyy') as BLDAT,
        // FORMAT (CONVERT(datetime, '{$datepost}'), 'dd.MM.yyyy') as BUDAT,    /* get from Post Date*/
        // '' as LDGRP,
        // '' as MONAT,
        // '' as VALUT,
        // '' as KURSF,
        // '' as XREF1_HD,
        // '' as XREF2_HD,
        // '' as XNEG,
        // '' as BSCHL,
        // '6004200000' as SAKNR,
        // vendorNo as LIFNR,
        // '' as KUNNR,
        // '' as UMSKZ,
        // '' as LOKKT,
        // 'THB' as WAERS,
        // truckerPayAmt as WRBTR,
        // '' as DMBTR,
        // '' as DMBE2,
        // '' as SHKZG,
        // '' as RCOMP,
        // '' as BEWAR,
        // '' as PS_POSID,
        // '' as AUFNR,
        // '1800A98201' as KOSTL,
        // '1800A9' as PRCTR,
        // '' as PPRCT,
        // '' as KKBER,
        // '' as FILKD,
        // '0001' as BUPLA,
        // '' as SECCO,
        // '' as LSTAR,
        // '' as FKBER,
        // '' as ZZONE,
        // 'VX' as MWSKZ,
        // '' as WMWST,
        // '' as MWSTS,
        // '' as FWBAS,
        // '' as HWBAS,
        // 'P1' as WITHT,
        // '11' as WT_WITHCD,
        // '' as WT_QSSHH,
        // truckerPayAmt as WT_QSSHB,
        // '' as WT_QSSH2,
        // '' as WT_QBSHH,
        // '' as WT_QBSHH_DC,
        // '' as WT_QBSH2,
        // '' as ZFBDT,
        // '' as ZTERM,
        // '' as ZBD1T,
        // '' as ZBD2T,
        // '' as ZBD3T,
        // '' as ZBD1P,
        // '' as ZBD2P,
        // '' as SKFBT,
        // '' as SKNTO,
        // '' as HBKID,
        // '' as HKTID,
        // '' as BVTYP,
        // '' as ZLSCH,
        // '' as UZAWE,
        // '' as ZLSPR,
        // '' as DTWS1,
        // '' as DTWS2,
        // '' as DTWS3,
        // '' as DTWS4,
        // '' as INVFO_PYCUR,
        // '' as INVFO_PYAMT,
        // '' as ALT_PAYEE,
        // '' as ALT_PAYEE_BANK,
        // '' as KIDNO,
        // CONCAT ( 'APT', FORMAT ( CONVERT ( datetime, drivingStart ), 'yyMMdd' ), '_', FORMAT ( CONVERT ( datetime, drivingEnd ), 'yyMMdd') ) as ZUONR,
        // CONCAT ( FORMAT ( CONVERT ( datetime, drivingStart ), 'yyyyMMdd' ), '_', FORMAT ( CONVERT ( datetime, drivingEnd ), 'yyyyMMdd') )  as SGTXT,
        // '' as MATNR,
        // '' as MEINS,
        // '' as MENGE,
        // '' as XREF1,
        // '' as XREF2,
        // '' as XREF3,
        // '' as KNDNR,
        // '' as VTWEG,
        // '' as SPART,
        // '' as WERKS,
        // '' as ARTNR,
        // '' as PRCTR1,
        // '' as VKORG,
        // '' as SEGMENT,
        // '' as KUNRE,
        // '' as KUNWE,
        // '' as KUNRG,
        // '' as PRDHA,
        // '' as PAPH1,
        // '' as PAPH2,
        // '' as PAPH3,
        // '' as PAPH4,
        // '' as PAPH5,
        // '' as PAPH6,
        // '' as PAPH7,
        // '' as PAPH8,
        // '' as MTART,
        // '' as MATKL,
        // '' as MVGR1,
        // '' as MVGR2,
        // '' as MVGR3,
        // '' as KDGRP,
        // '' as KVGR1,
        // '' as KVGR2,
        // '' as KVGR3,
        // '' as KVGR4,
        // '' as REGIO,
        // '' as VKGRP,
        // '' as VKBUR,
        // '' as WW001,
        // '' as AUART,
        // '' as CHARG,
        // '' as KMLAND,
        // '' as VBUND,
        // '' as ZEIFO,
        // '' as KDAUF,
        // '' as KDPOS,
        // '' as WW003_PA
        // FROM
        // tbt_TruckerPay_period AS t
        // WHERE drivingStart >= '{$datestart}' AND drivingEnd <= '{$dateend}'";
        $sql = "SELECT
 '1' AS NO,
        '1800' as BUKRS,
         t2.invoiceNo as  XBLNR,
  'KR' AS BLART,
  CONCAT ( FORMAT ( CONVERT ( datetime, drivingStart ), 'yyyyMMdd' ), '_', FORMAT ( CONVERT ( datetime, drivingEnd ), 'yyyyMMdd') ) AS BKTXT,
        FORMAT (truckerPayDate, 'dd.MM.yyyy') as BLDAT,
        FORMAT (CONVERT(datetime, '{$datepost}'), 'dd.MM.yyyy') as BUDAT,
        '' as LDGRP,
        '' as MONAT,
        '' as VALUT,
        '' as KURSF,
        '' as XREF1_HD,
        '' as XREF2_HD,
        '' as XNEG,
        '' as BSCHL,
        '6004200000' as SAKNR,
        t2.vendorNo as LIFNR,
        '' as KUNNR,
        '' as UMSKZ,
        '' as LOKKT,
        'THB' as WAERS,
        sum(truckerPayAmt) as WRBTR,
        '' as DMBTR,
        '' as DMBE2,
        '' as SHKZG,
        '' as RCOMP,
        '' as BEWAR,
        '' as PS_POSID,
        '' as AUFNR,
        '1800A98201' as KOSTL,
        '1800A9' as PRCTR,
        '' as PPRCT,
        '' as KKBER,
        '' as FILKD,
        '0001' as BUPLA,
        '' as SECCO,
        '' as LSTAR,
        '' as FKBER,
        '' as ZZONE,
        'VX' as MWSKZ,
        '' as WMWST,
        '' as MWSTS,
        '' as FWBAS,
        '' as HWBAS,
        'P1' as WITHT,
        '11' as WT_WITHCD,
        '' as WT_QSSHH,
        sum(truckerPayAmt) as WT_QSSHB,
        '' as WT_QSSH2,
        '' as WT_QBSHH,
        '' as WT_QBSHH_DC,
        '' as WT_QBSH2,
        '' as ZFBDT,
        '' as ZTERM,
        '' as ZBD1T,
        '' as ZBD2T,
        '' as ZBD3T,
        '' as ZBD1P,
        '' as ZBD2P,
        '' as SKFBT,
        '' as SKNTO,
        '' as HBKID,
        '' as HKTID,
        '' as BVTYP,
        '' as ZLSCH,
        '' as UZAWE,
        '' as ZLSPR,
        '' as DTWS1,
        '' as DTWS2,
        '' as DTWS3,
        '' as DTWS4,
        '' as INVFO_PYCUR,
        '' as INVFO_PYAMT,
        '' as ALT_PAYEE,
        '' as ALT_PAYEE_BANK,
        '' as KIDNO,
        CONCAT ( 'APT', FORMAT ( CONVERT ( datetime, drivingStart ), 'yyMMdd' ), '_', FORMAT ( CONVERT ( datetime, drivingEnd ), 'yyMMdd') ) as ZUONR,
        CONCAT ( FORMAT ( CONVERT ( datetime, drivingStart ), 'yyyyMMdd' ), '_', FORMAT ( CONVERT ( datetime, drivingEnd ), 'yyyyMMdd') )  as SGTXT,
        '' as MATNR,
        '' as MEINS,
        '' as MENGE,
        '' as XREF1,
        '' as XREF2,
        '' as XREF3,
        '' as KNDNR,
        '' as VTWEG,
        '' as SPART,
        '' as WERKS,
        '' as ARTNR,
        '' as PRCTR1,
        '' as VKORG,
        '' as SEGMENT,
        '' as KUNRE,
        '' as KUNWE,
        '' as KUNRG,
        '' as PRDHA,
        '' as PAPH1,
        '' as PAPH2,
        '' as PAPH3,
        '' as PAPH4,
        '' as PAPH5,
        '' as PAPH6,
        '' as PAPH7,
        '' as PAPH8,
        '' as MTART,
        '' as MATKL,
        '' as MVGR1,
        '' as MVGR2,
        '' as MVGR3,
        '' as KDGRP,
        '' as KVGR1,
        '' as KVGR2,
        '' as KVGR3,
        '' as KVGR4,
        '' as REGIO,
        '' as VKGRP,
        '' as VKBUR,
        '' as WW001,
        '' as AUART,
        '' as CHARG,
        '' as KMLAND,
        '' as VBUND,
        '' as ZEIFO,
        '' as KDAUF,
        '' as KDPOS,
        '' as WW003_PA

 from(
SELECT
min(t.invoiceNo) as invoiceNo,
t.vendorNo,
t.drivingStart,
t.drivingEnd,
t.truckerPayDate ,
sum(truckerPayAmt) as truckerPayAmt
FROM
tbt_TruckerPay_period AS t
GROUP BY t.vendorNo,
t.drivingStart,
t.drivingEnd,
t.truckerPayDate) as t2
WHERE   drivingStart >= '{$datestart}' AND drivingEnd <= '{$dateend}'
GROUP BY t2.invoiceNo,t2.vendorNo, t2.drivingStart,t2.drivingEnd,t2.truckerPayDate,t2.truckerPayAmt";
        $data = DB::select($sql);
        // dd($data);t2.vendorNo='8000004316' AND
        return view('exports.trucker_period_export', compact('data'));
    }
}
