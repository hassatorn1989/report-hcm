<?php

namespace App\Imports;

use App\Models\tbt_Payslip;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithUpserts;

class PaySlipSheet1Import implements ToModel, WithHeadingRow, WithBatchInserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new tbt_Payslip([
            'EmpCode' => $row['empcode'],
            'EmpName' => $row['empname'],
            'EmpNameEng' => $row['empnameeng'],
            'EmpType' => $row['emptype'],
            'PositionCode' => $row['positioncode'],
            'PositionName' => $row['positionname'],
            'PositionNameEng' => $row['positionnameeng'],
            'OrgUnitCode' => $row['orgunitcode'],
            'OrgUnitName' => $row['orgunitname'],
            'OrgUnitNameEng' => $row['orgunitnameeng'],
            'ParentOrgUnitCode' => $row['parentorgunitcode'],
            'ParentOrgUnitName' => $row['parentorgunitname'],
            'ParentOrgUnitNameEng' => $row['parentorgunitnameeng'],
            'PayDate' => date('Y-m-d', strtotime($row['paydate'])),
            'StartDateTemplate' => date('Y-m-d', strtotime($row['startdatetemplate'])),
            'PeriodDay' => $row['periodday'],
            'Salary' => $row['salary'],
            'TotalIncome' => $row['totalincome'],
            'TotalDeduct' => $row['totaldeduct'],
            'ProvidentFund' => $row['providentfund'],
            'Social' => $row['social'],
            'Organizer' => $row['organizer'],
            'OrganizerEng' => $row['organizereng'],
            'Auditor' => $row['auditor'],
            'AuditorEng' => $row['auditoreng'],
            'Approver' => $row['approver'],
            'ApproverEng' => $row['approvereng'],
            'CheckAssociates' => $row['checkassociates'],
            'EmpPaytax' => $row['emppaytax'],
            'NetIncome' => $row['netincome'],
            'EmployerPayTax' => $row['employerpaytax'],
            'CalcTaxType' => $row['calctaxtype'],
            'EmpType1' => $row['emptype1'],
            'PayPerMonth' => $row['paypermonth'],
            'PeriodStartDate' => $row['periodstartdate'],
            'PeriodEndDate' => $row['periodenddate'],
            'DayPerMonthDaily' => $row['daypermonthdaily'],
            'ResignInMonth' => $row['resigninmonth'],
            'ResignDate' => $row['resigndate'],
            'StartInMonth' => $row['startinmonth'],
            'StartDate' => $row['startdate'],
            'DayPerMonth' => $row['daypermonth'],
            'TimeWork' => $row['timework'],
            'Daynum' => $row['daynum'],
            'Income1' => $row['income1'],
            'Income2' => $row['income2'],
            'Income3' => $row['income3'],
            'Income4' => $row['income4'],
            'Income5' => $row['income5'],
            'Income6' => $row['income6'],
            'Income7' => $row['income7'],
            'Income8' => $row['income8'],
            'Income9' => $row['income9'],
            'Income10' => $row['income10'],
            'Income11' => $row['income11'],
            'Income12' => $row['income12'],
            'Income13' => $row['income13'],
            'Income14' => $row['income14'],
            'Income15' => $row['income15'],
            'Income16' => $row['income16'],
            'Income17' => $row['income17'],
            'Income18' => $row['income18'],
            'Income19' => $row['income19'],
            'Income20' => $row['income20'],
            'Deduct1' => $row['deduct1'],
            'Deduct2' => $row['deduct2'],
            'Deduct3' => $row['deduct3'],
            'Deduct4' => $row['deduct4'],
            'Deduct5' => $row['deduct5'],
            'Deduct6' => $row['deduct6'],
            'Deduct7' => $row['deduct7'],
            'Deduct8' => $row['deduct8'],
            'Deduct9' => $row['deduct9'],
            'Deduct10' => $row['deduct10'],
            'Deduct11' => $row['deduct11'],
            'Deduct12' => $row['deduct12'],
            'Deduct13' => $row['deduct13'],
            'Deduct14' => $row['deduct14'],
            'Deduct15' => $row['deduct15'],
            'Deduct16' => $row['deduct16'],
            'Deduct17' => $row['deduct17'],
            'Deduct18' => $row['deduct18'],
            'Deduct19' => $row['deduct19'],
            'Deduct20' => $row['deduct20'],
            'OtherIncome' => $row['otherincome'],
            'OtherDeduct' => $row['otherdeduct'],
            'EffectDate' => (!is_null($row['effectdate'])) ? date('Y-m-d', strtotime($row['effectdate'])) : null,
            'WorkStartDate' => date('Y-m-d', strtotime($row['workstartdate'])),
            'WorkPeriodDay' => $row['workperiodday'],
            'ResignWorkDate' => $row['resignworkdate'],
            'AmountDateBetPeriod' => $row['amountdatebetperiod'],
            'WorkDayAll' => $row['workdayall'],
            'CalcIncomeOccasionalAt' => (!is_null($row['calcincomeoccasionalat'])) ? date('Y-m-d', strtotime($row['calcincomeoccasionalat'])) : null,
            'BaseSalary' => $row['basesalary'],
            'isActive' => 'Y',
            'printStatus' => 'N',
        ]);
    }

    public function batchSize(): int
    {
        return 20;
    }

    public function uniqueBy()
    {
        return ['EmpCode', 'OrgUnitCode', 'PayDate'];
    }
}
