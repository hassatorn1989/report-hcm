<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class empoyee_controller extends Controller
{
    public function index(Request $request)
    {
        $sql = "SELECT
        e.orgCopCode,
        e.empCode,
        e.titleNameEN,
        e.firstNameEN,
        e.lastNameEN,
        e.titleNameTH,
        e.firstNameTH,
        e.lastNameTH,
        e.orgDivCode,
        e.orgDepCode,
        e.orgJobCode,
        e.orgLineCode,
        e.addressLine1,
        e.addressLine2,
        e.addressLine3,
        e.postCode,
        e.SSNO,
        e.IDCard,
        e.mobile,
        e.birthDate,
        e.dateFr,
        e.dateSt,
        e.dateEx,
        e.sex,
        e.empStatus,
        e.levelCode,
        e.positinCode,
        e.paymentBank,
        e.busRate,
        e.pregnantFlag,
        e.religion,
        e.nationality,
        e.isActive,
        org.orgUnitNameEN,
        org.orgUnitNameTH
        FROM
        dbo.tbm_Employee AS e
        INNER JOIN dbo.tbm_OrgUnit AS org ON e.orgCopCode = org.orgCopCode AND e.orgDivCode = org.orgDivCode AND e.orgDepCode = org.orgDepCode";

        $q = DB::select($sql);
        if (!empty($q)) {
            $data = [
                'status' => true,
                'data' => $q,
            ];
        } else {
            $data = [
                'status' => false
            ];
        }
        return response()->json($data);
    }
}
