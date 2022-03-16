<?php

namespace App\Http\Controllers;

use App\Models\tb_user;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboard_controller extends Controller
{
    public function index()
    {
        // select top 1 aa. dateIn tbt_TimeWorking_hour as aa order by aa.dateIn DESC
        $q1 = DB::selectOne("SELECT  count(t.dateIn) as qtyEmp, ( select top 1 aa.dateIn from tbt_TimeWorking_hour as aa order by aa.dateIn DESC) as datenow from( SELECT t.dateIn FROM dbo.tbt_TimeWorking_hour AS t WHERE t.dateIn= ( select top 1 aa.dateIn from tbt_TimeWorking_hour as aa order by aa.dateIn DESC) GROUP BY t.empCode,t.dateIn) as t");
        $q2 = DB::selectOne("SELECT ({$q1->qtyEmp}*100/count(t.empCode)) as  qty FROM dbo.tbm_Employee AS t WHERE t.isActive='Y'");
        $q3 = DB::select("SELECT
            o.orgDivCode,
            o.orgUnitNameEN,
            (t2.workingEMP*100/t2.totalEMP) as percen
            from(
            SELECT
            org.orgDivCode,
            Count(e.empCode) AS totalEMP,
            (SELECT
            count(t.empCode) as workingEMP
            FROM
            dbo.tbt_TimeWorking_hour AS t
            INNER JOIN dbo.tbm_Employee AS emp ON t.orgCopCode = emp.orgCopCode AND t.empCode = emp.empCode
            WHERE t.accountType='R' AND t.dateIn=GETDATE() AND emp.orgDivCode=org.orgDivCode
            GROUP BY emp.orgDivCode) AS workingEMP
            FROM
            dbo.tbm_Employee AS e
            INNER JOIN dbo.tbm_OrgUnit AS org ON e.orgDivCode = org.orgDivCode AND e.orgDepCode = org.orgDepCode
            GROUP BY org.orgDivCode) as t2
            INNER JOIN tbm_OrgUnit as o on o.orgDivCode=t2.orgDivCode AND o.orgTypeCode='2'");

        $q4 = DB::select("SELECT
                count(empCode) as empCode,
            dateIn
            FROM
                tbt_TimeWorking_hour
            WHERE
                (
                    dateIn BETWEEN FORMAT (
                        CONVERT (
                            datetime,
                            DATEADD(DAY, - 7, GETDATE())
                        ),
                        'yyyy-MM-dd'
                    )
                    AND GETDATE()
                )
            AND accountType = 'R'
            GROUP BY dateIn
            ORDER BY
	        dateIn DESC");
        return view('dashboard', compact('q1', 'q2', 'q3', 'q4'));
    }
}
