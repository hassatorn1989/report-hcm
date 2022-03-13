<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <title> HCM</title>

    <style type="text/css">
        /*!---------- #HeavenZest  font-family: "Sarabun" ----------*/
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ url('storage/fonts/THSarabunNew.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'WinInnwa';
            font-style: normal;
            font-weight: normal;
            src: url("{{ url('storage/fonts/WinInnwa.ttf') }}") format('truetype');
        }

        body,
        div,
        p,
        span {
            font-family: 'THSarabunNew';
            font-size: 12px;
            font-weight: 400;
            line-height: 1.35em;
            vertical-align: baseline;
        }

        body {
            margin: 0;
            padding: 0;
            text-align: center;
        }

        div {
            display: inline-table;
            position: relative;
            margin: 0;
            padding: 3px 4px;
            vertical-align: middle;
        }

        div# {
            border: 0.4px dotted #d7d7d7;
        }

        div.bb {
            padding: 0;
            text-align: left;
        }

        div.bb>div {
            padding: 3px 4px 2.5px 4px;
        }

        div.bc {
            padding: 0 4px;
            width: inherit;
            text-align: left;
        }

        div.bc>div {
            padding: 3px 4px 2.5px 4px;
        }

        div.bd {
            padding: 0;
        }

        div.bd>div {
            padding: 4px 0 2.5px 0;
            width: 100%;
        }

        div.bd .bdd {
            padding: 3px 0 2px 0;
        }

        div.be1 {
            padding: 0 4px 0 0;
            text-align: right;
        }

        div.be2 {
            padding: 0 16px 0 0;
            text-align: right;
            text-decoration: underline;
        }

        div.bz {
            padding: 0 4px 2px 4px;
            width: 100%;
            text-align: left;
        }

        div.t {
            border-top: 1.2px solid #000;
        }

        div.l {
            border-left: 1.2px solid #000;
        }

        div.r {
            border-right: 1.2px solid #000;
        }

        div.f {
            border-bottom: 1.2px solid #000;
        }

        .TH12 {
            font-size: 12px;
        }

        .TH13 {
            font-size: 13px;
        }

        .TH14 {
            font-size: 14px;
        }

        .MM15 {
            font: 15.4px 'WinInnwa';
        }

        .MM16 {
            font: 16.4px 'WinInnwa';
        }

        .MM17 {
            font: 17.4px 'WinInnwa';
        }

        .b {
            font-weight: 600;
        }

    </style>

<body>
    <div style="padding:4px; width:404px;">

        <!-------------------- Section 1 -------------------->
        <div style="margin:0 0 3px 0;">
            <span class="TH14 b">บริษัท โดลไทยแลนด์ จำกัด</span><br>
            <span class="MM17">'dk;vf xdkif;vif;ukrÜPD vDrdwuf </span>
        </div><br>
        <!---------------------------------------->
        <div style="margin:0 0 6px 0; width:64%; border:double;">
            <span class="TH13 b">ใบแสดงรายการค่าแรง</span><br>
            <span class="MM16 b">vkyftm;ctcsdefNypm&amp;if; </span>
        </div><br>

        <!-------------------- Section 2 -------------------->
        @php
            $b_size = '96.5%';
            $b_size1 = '18%';
            $b_size2 = '76%';
            $b_size3 = '26%';
            $b_size4 = '24%';
            $b_size5 = '22%';
            $rate = $rows->BaseSalary != 0 ? number_format($rows->BaseSalary / 8, 3) : 0;
        @endphp
        <div align="left" class="bb" style="margin:0 0 3px 12px; width:{{ $b_size }};">
            <div style="width:{{ $b_size1 }};">
                <span class="TH12">ชื่อ :</span><br>
                <span class="MM15">trnf </span>
            </div>
            <div style="width:{{ $b_size2 }}; line-height:1.48em; padding-bottom:0;">
                <span class="TH13 b">
                    <span class="TH13 b">{{ $rows->EmpNameEng }}</span>
            </div>
            <br>
            <div style="width:{{ $b_size1 }};">
                <span class="TH12">หมายเลข :</span><br>
                <span class="MM15">eHywfpOf </span>
            </div>
            <div style="width:{{ $b_size3 }};">
                <span class="TH12 b">{{ $rows->EmpCode }}</span>
            </div>
            <div style="width:{{ $b_size4 }};">
                <span class="TH12">อัตรา/ชม. :</span><br>
                <span class="MM15">em&amp;DvkyfceSkef;xm; </span>
            </div>
            <div style="width:{{ $b_size5 }};">
                <span class="TH12 b">{{ $rate }}</span>
            </div>
            <br>
            <div style="width:{{ $b_size1 }};">
                <span class="TH12">วันที่ :</span><br>
                <span class="MM15">tywfpOf </span>
            </div>
            <div style="width:{{ $b_size3 }};">
                <span class="TH12 b">{{ $rows->StartDate2 }}</span>
            </div>

            <div style="width:{{ $b_size4 }};">
                <span class="TH12">ถึง :</span><br>
                <span class="MM15">owfrSwf&amp;ufumv </span>
            </div>
            <div style="width:{{ $b_size5 }};">
                <span class="TH12 b">{{ $rows->PayDate2 }}</span>
            </div>
        </div><br>

        <!-------------------- Section 3 -------------------->
        @php
            $b_size1 = '33%';
            $b_size2 = '10%';
            $b_size3 = '12%';
            $b_size4 = '12%';
            $b_size5 = '20%';
            $check_wage = 0;
        @endphp
        <div style="margin:0 0 6px 0; padding:0; width:{{ $b_size }};">
            <div class="bc t l r">
                <div style="width:{{ $b_size1 }};">
                    <span class="TH12">ค่าแรงปกติ :</span><br>
                    <span class="MM15">yHkrSefvkyftm;c </span>
                </div>
                <div style="width:{{ $b_size2 }};">
                    <span class="TH12">(1.0)</span>
                </div>
                <div style="width:{{ $b_size3 }}; text-align:right;">
                    <span class="TH12">{{ hourly($rows->Income1, $rate * 1.0) }}
                        {{-- //-------------------- #check_rate -------------------- --}}

                        @if ($check_wage == 1)
                            {{ "<br><font color='red'>" . number_format($rate * 1.0, 3) . '</font>' }}
                        @endif
                    </span>
                </div>
                <div class="r" style="width:{{ $b_size4 }};">
                    <span class="TH12">ชม.</span><br>
                    <span class="MM15">em&amp;D </span>
                </div>
                <div style="width:{{ $b_size5 }}; text-align:right;">
                    <span class="TH12 b">{{ number_format($rows->Income1, 2) }}
                        {{-- //-------------------- #check_wage -------------------- --}}
                        @if ($check_wage == 1)
                            {{ "<br><font color='red'>" . hourly_wage($rows->Income1, $rate * 1.0) . '</font>' }}
                        @endif
                    </span>
                </div>
            </div>
            <!---------------------------------------->
            <div class="bc t l r">
                <div style="width:{{ $b_size1 }};">
                    <span class="TH12">ค่าแรงวันหยุด :</span><br>
                    <span class="MM15">ydwf&ufvkyftm;c </span>
                </div>
                <div style="width:{{ $b_size2 }};">
                    <span class="TH12">(2.0)</span>
                </div>
                <div style="width:{{ $b_size3 }}; text-align:right;">
                    <span class="TH12">{{ hourly($rows->Income3, $rate * 2.0) }}
                        {{-- //-------------------- #check_rate -------------------- --}}
                        @if ($check_wage == 1)
                            {{ "<br><font color='red'>" . number_format($rate * 2.0, 3) . '</font>' }}
                        @endif
                    </span>
                </div>
                <div class="r" style="width:{{ $b_size4 }};">
                    <span class="TH12">ชม.</span><br>
                    <span class="MM15">em&amp;D </span>
                </div>
                <div style="width:{{ $b_size5 }}; text-align:right;">
                    <span class="TH12 b">{{ number_format($rows->Income3, 2) }}
                        {{-- //-------------------- #check_wage -------------------- --}}
                        @if ($check_wage == 1)
                            {{ "<br><font color='red'>" . hourly_wage($rows->Income3, $rate * 2.0) . '</font>' }}
                        @endif
                    </span>
                </div>
            </div>

            <div class="bc t l r">
                <div style="width:{{ $b_size1 }};">
                    <span class="TH12">ค่าแรงวันนักขัตฤกษ์ :</span><br>
                    <span class="MM15">tpdk;&amp;&amp;Hk;ydwf&amp;ufvkyftm;c </span>
                </div>
                <div style="width:{{ $b_size2 }};">
                    <span class="TH12">(2.5)</span>
                </div>
                <div style="width:{{ $b_size3 }}; text-align:right;">
                    <span class="TH12">{{ hourly($rows->Income4, $rate * 2.5) }}
                        {{-- //-------------------- #check_rate -------------------- --}}
                        @if ($check_wage == 1)
                            {{ "<br><font color='red'>" . number_format($rate * 2.5, 3) . '</font>' }}
                        @endif
                    </span>
                </div>
                <div class="r" style="width:{{ $b_size4 }};">
                    <span class="TH12">ชม.</span><br>
                    <span class="MM15">em&amp;D </span>
                </div>
                <div style="width:{{ $b_size5 }}; text-align:right;">
                    <span class="TH12 b">{{ number_format($rows->Income4, 2) }}
                        {{-- //-------------------- #check_wage -------------------- --}}
                        @if ($check_wage == 1)
                            {{ "<br><font color='red'>" . hourly_wage($rows->Income4, $rate * 2.5) . '</font>' }}
                        @endif
                    </span>
                </div>
            </div>
            <div class="bc t l r f">
                <div style="width:{{ $b_size1 }};">
                    <span class="TH12">ค่าล่วงเวลา(วันหยุด) :</span><br>
                    <span class="MM15">ydwf&uftcdsefydkvkyfc </span>
                </div>
                <div style="width:{{ $b_size2 }};">
                    <span class="TH12">(3.0)</span>
                </div>
                <div style="width:{{ $b_size3 }}; text-align:right;">
                    <span class="TH12">{{ hourly($rows->Income5, $rate * 3.0) }}
                        {{-- //-------------------- #check_rate -------------------- --}}
                        @if ($check_wage == 1)
                            {{ "<br><font color='red'>" . number_format($rate * 3.0, 3) . '</font>' }}
                        @endif
                    </span>
                </div>
                <div class="r" style="width:{{ $b_size4 }};">
                    <span class="TH12">ชม.</span><br>
                    <span class="MM15">em&amp;D </span>
                </div>
                <div style="width:{{ $b_size5 }}; text-align:right;">
                    <span class="TH12 b">{{ number_format($rows->Income5, 2) }}
                        {{-- //-------------------- #check_wage -------------------- --}}
                        @if ($check_wage == 1)
                            {{ "<br><font color='red'>" . hourly_wage($rows->Income5, $rate * 3.0) . '</font>' }}
                        @endif
                    </span>
                </div>
            </div>


        </div><br>



        <!-------------------- Section 4 -------------------->
        @php
            $b_size1 = '19.62%';
            $b_size2 = '74%';
            $b_size3 = '20%';
        @endphp
        <div style="margin:0 0 4px 0; padding:0; width:{{ $b_size }};">
            <div class="bd t l" style="width:{{ $b_size1 }};">
                <div class="f">
                    <span class="TH12">ป่วย</span><br>
                    <span class="MM15">aq;cGifh</span>
                </div><br>
                <div class="bdd">
                    <span class="TH12 b">{{ number_format($rows->Income13, 2) }}</span>
                </div>
            </div>

            <!---------------------------------------->
            <!---------------------------------------->
            <div class="bd t l f" style="width:{{ $b_size1 }};">
                <div class="f">
                    <span class="TH12">ลากิจ</span><br>
                    <span class="MM15">a&Smifw <br>cifcGifh </span>
                </div><br>
                <div class="bdd">
                    <span class="TH12 b">{{ number_format($rows->Income6, 2) }}</span>
                </div>
            </div>
            <!---------------------------------------->
            <div class="bd t l f" style="width:{{ $b_size1 }};">
                <div class="f">
                    <span class="TH12">ค่ากะ</span><br>
                    <span class="MM15">txl; <br>abmeyfpfaiG </span>
                </div><br>
                <div class="bdd">
                    <span class="TH12 b">{{ number_format($rows->Income7, 2) }}</span>
                </div>
            </div>
            <!---------------------------------------->
            <div class="bd t l f" style="width:{{ $b_size1 }};">
                <div class="f">
                    <span class="TH12">พักร้อน</span><br>
                    <span class="MM15">aEG&moD <br>tm;vyf&ufcGifh </span>
                </div><br>
                <div class="bdd">
                    <span class="TH12 b">{{ number_format($rows->Income14 + $rows->Income15, 2) }}</span>
                </div>
            </div>
            <!---------------------------------------->
            <div class="bd t l f" style="width:{{ $b_size1 }};">
                <div class="f">
                    <span class="TH12">วันหยุด</span><br>
                    <span class="MM15">ydwf&uf <br>vkyfcaiG </span>
                </div><br>
                <div class="bdd">
                    <span class="TH12 b">{{ number_format($rows->Income10, 2) }}</span>
                </div>
            </div>
            <!---------------------------------------->
            <div class="bd t l r f" style="width:{{ $b_size1 }};">
                <div class="f">
                    <span class="TH12">อื่น ๆ</span><br>
                    <span class="MM15">tNcm; <br>taxGaxG </span>
                </div><br>
                <div class="bdd">
                    <span class="TH12 b">{{ number_format($rows->Income18 + $rows->OrtherIncome, 2) }}</span>
                </div>
            </div>
        </div><br>
        <!---------------------------------------->
        <!---------------------------------------->
        <div style="margin:0 0 6px 0; padding:0; width:{{ $b_size }};">
            <div class="be1" style="width:{{ $b_size2 }};">
                <span class="TH13 b">รวมเงิน/</span>
                <span class="MM16 b">&amp;aiGpkpkaygif; </span>
            </div>
            <div class="be2" style="width:{{ $b_size3 }};">
                <span class="TH13 b">{{ number_format($rows->TotalIncome, 2) }}</span>
            </div>
        </div><br>


        <!-------------------- Section 5 -------------------->
        @php
            $b_size1 = '19.62%';
            $b_size2 = '74%';
            $b_size3 = '20%';
        @endphp
        <div style="margin:0 0 4px 0; padding:0; width:{{ $b_size }};">
            <div class="bd t l f" style="width:{{ $b_size1 }};">
                <div class="f">
                    <span class="TH12">ภาษี</span><br>
                    <span class="MM15">tcGef <br>&nbsp;</span>
                </div><br>
                <div class="bdd">
                    <span class="TH12 b">{{ number_format($rows->EmpPaytax, 2) }}</span>
                </div>
            </div>
            <!---------------------------------------->
            <div class="bd t l f" style="width:{{ $b_size1 }};">
                <div class="f">
                    <span class="TH12">ประกันฯ</span><br>
                    <span class="MM15">vlrSkzlvHka&; <br>tmrcH </span>
                </div><br>
                <div class="bdd">
                    <span class="TH12 b">{{ number_format($rows->Social, 2) }}</span>
                </div>
            </div>
            <!---------------------------------------->
            <div class="bd t l f" style="width:{{ $b_size1 }};">
                <div class="f">
                    <span class="TH12">กองทุนฯ</span><br>
                    <span class="MM15">tpk&S,f,m <br>&efyHkaiG </span>
                </div><br>
                <div class="bdd">
                    <span class="TH12 b">{{ number_format($rows->ProvidentFund, 2) }}</span>
                </div>
            </div>
            <!---------------------------------------->
            <div class="bd t l f" style="width:{{ $b_size1 }};">
                <div class="f">
                    <span class="TH12">สหกรณ์</span><br>
                    <span class="MM15">or0g,r <br>xnfh0ifaiG </span>
                </div><br>
                <div class="bdd">
                    <span class="TH12 b">{{ number_format($rows->Deduct1, 2) }}</span>
                </div>
            </div>
            <!---------------------------------------->
            <div class="bd t l r f" style="width:{{ $b_size1 }};">
                <div class="f">
                    <span class="TH12">หักอื่น ๆ</span><br>
                    <span class="MM15">NzwfaiG <br>taxGaxG </span>
                </div><br>
                <div class="bdd">
                    <span class="TH12 b">{{ number_format($rows->Deduct2 + $rows->OtherDeduct, 2) }}</span>
                </div>
            </div>
        </div><br>
        <!---------------------------------------->
        <!---------------------------------------->
        <div style="margin:0 0 6px 0; padding:0; width:{{ $b_size }};">
            <div class="be1" style="width:{{ $b_size2 }};">
                <span class="TH13 b">รวมเงินหัก/</span>
                <span class="MM16 b">eSkwf,laiGpkpkaygif; </span>
            </div>
            <div class="be2" style="width:{{ $b_size3 }};">
                <span class="TH13 b">{{ number_format($rows->TotalDeduct, 2) }}</span>
            </div>
        </div><br>
        <!---------------------------------------->
        <div style="margin:0 0 6px 0; padding:0; width:{{ $b_size }};">
            <div class="be1" style="width:{{ $b_size2 }};">
                <span class="TH13 b">รวมเงินสุทธิ/</span>
                <span class="MM16 b">pkpkaygif;tom;wif&amp;aiG </span>
            </div>
            <div class="be2" style="width:{{ $b_size3 }};">
                <span class="TH13 b">{{ number_format($rows->NetIncome, 2) }}</span>
            </div>
        </div><br>

        <!-------------------- Section 6 -------------------->
        <div style="margin:0; padding:0; width:{{ $b_size }};">
            <div class="bz">
                <span class="TH12">Printed : {{ date('d/m/Y  h:i:s') }}</span>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        window.print();
    });
</script>

</html>
