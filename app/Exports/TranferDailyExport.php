<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class TranferDailyExport implements FromView
{
    protected $date_export_tranfer_daily;
    protected $date_post;

    function __construct($date_export_tranfer_daily, $date_post)
    {
        $this->date_export_tranfer_daily = $date_export_tranfer_daily;
        $this->date_post = $date_post;
    }
    public function view(): View
    {
        // $datecut = explode(" - ", $this->date_export_tranfer_daily);
        // $datestart = date('Y-m-d', strtotime(str_replace('/', '-', $datecut[0])));
        // $dateend = date('Y-m-d', strtotime(str_replace('/', '-', $datecut[1])));
        // $datepost = date('Y-m-d', strtotime($this->date_post));
        // // ROW_NUMBER() OVER (ORDER BY  t.companyCode ASC)
        // $sql = "SELECT
        // '1' AS NO,
        // t.companyCode as BUKRS,
        // CONCAT ( 'JVM', FORMAT ( CONVERT ( datetime, '{$datestart}' ), 'yyMMdd' ), '_', FORMAT ( CONVERT ( datetime, '{$dateend}' ), 'yyMMdd') ) AS XBLNR,
        // 'PL' AS BLART,
        // CONCAT ( FORMAT ( CONVERT ( datetime, '{$datestart}' ), 'yyyyMMdd' ), '_', FORMAT ( CONVERT ( datetime, '{$dateend}' ), 'yyyyMMdd') ) AS BKTXT,
        // FORMAT (t.tdate, 'dd.MM.yyyy') as BLDAT,
        // FORMAT (CONVERT(datetime, '{$datepost}'), 'dd.MM.yyyy') as BUDAT,
        // '' as LDGRP,
        // '' as MONAT,
        // '' as VALUT,
        // '' as KURSF,
        // '' as XREF1_HD,
        // '' as XREF2_HD,
        // '' as XNEG,
        // '' as BSCHL,
        // t.accountCode as SAKNR,
        // '' as LIFNR,
        // '' as KUNNR,
        // '' as UMSKZ,
        // '' as LOKKT,
        // 'THB' as WAERS,
        // t.amtWage as WRBTR,
        // '' as DMBTR,
        // '' as DMBE2,
        // '' as SHKZG,
        // '' as RCOMP,
        // '' as BEWAR,
        // '' as PS_POSID,
        // t.ioNumber as AUFNR,
        // t.costCenter as KOSTL,
        // '' as PRCTR,
        // '' as PPRCT,
        // '' as KKBER,
        // '' as FILKD,
        // '0001' as BUPLA,
        // '' as SECCO,
        // '' as LSTAR,
        // '' as FKBER,
        // '' as ZZONE,
        // '' as MWSKZ,
        // '' as WMWST,
        // '' as MWSTS,
        // '' as FWBAS,
        // '' as HWBAS,
        // '' as WITHT,
        // '' as WT_WITHCD,
        // '' as WT_QSSHH,
        // '' as WT_QSSHB,
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
        // '' as  ZUONR,
        // t.jvReferance as SGTXT,
        // '' as MATNR,
        // 'H' as MEINS,
        // t.amtHour as MENGE,
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
        // from (
        // SELECT
        // t.transferDate as tdate,
        // '1800' as companyCode,
        // t.costCenter,
        // t.accountCode,
        // t.ioNumber,
        // t.amtWage,
        // t.amtHour,
        // t.jvReferance
        // FROM
        // dbo.tbc_JV_Transfer_daily AS t
        // WHERE t.transferDate BETWEEN '{$datestart}' AND '{$dateend}' AND t.isActive='Y'
        // UNION ALL
        // SELECT
        // t.payrollDate  as tdate,
        // '1800' as companyCode,
        // t.costCenter,
        // t.accountCode,
        // t.ioNumber,
        // t.amtWage,
        // t.amtHour,
        // '' as jvReferance
        // FROM
        // dbo.tbc_JV_Payroll_period AS t
        // WHERE t.payrollDate BETWEEN '{$datestart}' AND '{$dateend}' AND t.isActive='Y') as t";
        // $data = DB::select($sql);
        // return view('exports.accrue_daily_export', compact('data'));

        $datecut = explode(" - ", $this->date_export_tranfer_daily);
        $datestart = date('Y-m-d', strtotime(str_replace('/', '-', $datecut[0])));
        $dateend = date('Y-m-d', strtotime(str_replace('/', '-', $datecut[1])));
        $datepost = date('Y-m-d', strtotime($this->date_post));
        // ROW_NUMBER() OVER (ORDER BY  t.companyCode ASC)
        $sql = "SELECT
        '1' AS NO,
        t.companyCode as BUKRS,
        CONCAT ( 'JVM', FORMAT ( CONVERT ( datetime, '{$datestart}' ), 'yyMMdd' ), '_', FORMAT ( CONVERT ( datetime, '{$dateend}' ), 'yyMMdd') ) AS XBLNR,
		'PL' AS BLART,
		CONCAT ( FORMAT ( CONVERT ( datetime, '{$datestart}' ), 'yyyyMMdd' ), '_', FORMAT ( CONVERT ( datetime, '{$dateend}' ), 'yyyyMMdd') ) AS BKTXT,
        FORMAT (t.tdate, 'dd.MM.yyyy') as BLDAT,
        FORMAT (CONVERT(datetime, '{$datepost}'), 'dd.MM.yyyy') as BUDAT,
        '' as LDGRP,
        '' as MONAT,
        '' as VALUT,
        '' as KURSF,
        '' as XREF1_HD,
        '' as XREF2_HD,
        '' as XNEG,
        '' as BSCHL,
        t.accountCode as SAKNR,
        '' as LIFNR,
        '' as KUNNR,
        '' as UMSKZ,
        '' as LOKKT,
        'THB' as WAERS,
        t.amtWage as WRBTR,
        '' as DMBTR,
        '' as DMBE2,
        '' as SHKZG,
        '' as RCOMP,
        '' as BEWAR,
        '' as PS_POSID,
        t.ioNumber as AUFNR,
        t.costCenter as KOSTL,
        '' as PRCTR,
        '' as PPRCT,
        '' as KKBER,
        '' as FILKD,
        '0001' as BUPLA,
        '' as SECCO,
        '' as LSTAR,
        '' as FKBER,
        '' as ZZONE,
        '' as MWSKZ,
        '' as WMWST,
        '' as MWSTS,
        '' as FWBAS,
        '' as HWBAS,
        '' as WITHT,
        '' as WT_WITHCD,
        '' as WT_QSSHH,
        '' as WT_QSSHB,
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
        '' as  ZUONR,
        t.jvReferance as SGTXT,
        '' as MATNR,
        'H' as MEINS,
        t.amtHour as MENGE,
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
        from (
        SELECT
        t.transferDate as tdate,
        '1800' as companyCode,
        t.costCenter,
        t.accountCode,
        t.ioNumber,
        t.amtWage,
        t.amtHour,
        t.jvReferance
        FROM
        dbo.tbc_JV_Transfer_daily AS t
        WHERE t.transferDate BETWEEN '{$datestart}' AND '{$dateend}' AND t.isActive='Y'
        UNION ALL
        SELECT
        t.payrollDate  as tdate,
        '1800' as companyCode,
        t.costCenter,
        t.accountCode,
        t.ioNumber,
        t.amtWage,
        t.amtHour,
        '' as jvReferance
        FROM
        dbo.tbc_JV_Payroll_period AS t
        WHERE t.payrollDate BETWEEN '{$datestart}' AND '{$dateend}' AND t.isActive='Y') as t";
        $data = DB::select($sql);
            dd($data);
        return view('exports.accrue_daily_export', compact('data'));
    }
}
