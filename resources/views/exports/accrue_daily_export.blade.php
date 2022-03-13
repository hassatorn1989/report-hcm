<table>
    <thead>
        <tr>
            <th>No</th>
            <th>BUKRS</th>
            <th>XBLNR</th>
            <th>BLART</th>
            <th>BKTXT</th>
            <th>BLDAT</th>
            <th>BUDAT</th>
            <th>LDGRP</th>
            <th>MONAT</th>
            <th>VALUT</th>
            <th>KURSF</th>
            <th>XREF1_HD</th>
            <th>XREF2_HD</th>
            <th>XNEG</th>
            <th>BSCHL</th>
            <th>SAKNR</th>
            <th>LIFNR</th>
            <th>KUNNR</th>
            <th>UMSKZ</th>
            <th>LOKKT</th>
            <th>WAERS</th>
            <th>WRBTR</th>
            <th>DMBTR</th>
            <th>DMBE2</th>
            <th>SHKZG</th>
            <th>RCOMP</th>
            <th>BEWAR</th>
            <th>PS_POSID</th>
            <th>AUFNR</th>
            <th>KOSTL</th>
            <th>PRCTR</th>
            <th>PPRCT</th>
            <th>KKBER</th>
            <th>FILKD</th>
            <th>BUPLA</th>
            <th>SECCO</th>
            <th>LSTAR</th>
            <th>FKBER</th>
            <th>ZZONE</th>
            <th>MWSKZ</th>
            <th>WMWST</th>
            <th>MWSTS</th>
            <th>FWBAS</th>
            <th>HWBAS</th>
            <th>WITHT</th>
            <th>WT_WITHCD</th>
            <th>WT_QSSHH</th>
            <th>WT_QSSHB</th>
            <th>WT_QSSH2</th>
            <th>WT_QBSHH</th>
            <th>WT_QBSHH_DC</th>
            <th>WT_QBSH2</th>
            <th>ZFBDT</th>
            <th>ZTERM</th>
            <th>ZBD1T</th>
            <th>ZBD2T</th>
            <th>ZBD3T</th>
            <th>ZBD1P</th>
            <th>ZBD2P</th>
            <th>SKFBT</th>
            <th>SKNTO</th>
            <th>HBKID</th>
            <th>HKTID</th>
            <th>BVTYP</th>
            <th>ZLSCH</th>
            <th>UZAWE</th>
            <th>ZLSPR</th>
            <th>DTWS1</th>
            <th>DTWS2</th>
            <th>DTWS3</th>
            <th>DTWS4</th>
            <th>INVFO_PYCUR</th>
            <th>INVFO_PYAMT</th>
            <th>ALT_PAYEE</th>
            <th>ALT_PAYEE_BANK</th>
            <th>KIDNO</th>
            <th>ZUONR</th>
            <th>SGTXT</th>
            <th>MATNR</th>
            <th>MEINS</th>
            <th>MENGE</th>
            <th>XREF1</th>
            <th>XREF2</th>
            <th>XREF3</th>
            <th>KNDNR</th>
            <th>VTWEG</th>
            <th>SPART</th>
            <th>WERKS</th>
            <th>ARTNR</th>
            <th>PRCTR1</th>
            <th>VKORG</th>
            <th>SEGMENT</th>
            <th>KUNRE</th>
            <th>KUNWE</th>
            <th>KUNRG</th>
            <th>PRDHA</th>
            <th>PAPH1</th>
            <th>PAPH2</th>
            <th>PAPH3</th>
            <th>PAPH4</th>
            <th>PAPH5</th>
            <th>PAPH6</th>
            <th>PAPH7</th>
            <th>PAPH8</th>
            <th>MTART</th>
            <th>MATKL</th>
            <th>MVGR1</th>
            <th>MVGR2</th>
            <th>MVGR3</th>
            <th>KDGRP</th>
            <th>KVGR1</th>
            <th>KVGR2</th>
            <th>KVGR3</th>
            <th>KVGR4</th>
            <th>REGIO</th>
            <th>VKGRP</th>
            <th>VKBUR</th>
            <th>WW001</th>
            <th>AUART</th>
            <th>CHARG</th>
            <th>KMLAND</th>
            <th>VBUND</th>
            <th>ZEIFO</th>
            <th>KDAUF</th>
            <th>KDPOS</th>
            <th>WW003_PA</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
        <tr>
            <td>{{ $row->NO }} </td>
            <td>{{ $row->BUKRS }} </td>
            <td>{{ $row->XBLNR }} </td>
            <td>{{ $row->BLART }} </td>
            <td>{{ $row->BKTXT }} </td>
            <td>{{ $row->BLDAT }} </td>
            <td>{{ $row->BUDAT }} </td>
            <td>{{ $row->LDGRP }} </td>
            <td>{{ $row->MONAT }} </td>
            <td>{{ $row->VALUT }} </td>
            <td>{{ $row->KURSF }} </td>
            <td>{{ $row->XREF1_HD }}</td>
            <td>{{ $row->XREF2_HD }}</td>
            <td>{{ $row->XNEG }}</td>
            <td>{{ $row->BSCHL }}</td>
            <td>{{ $row->SAKNR }}</td>
            <td>{{ $row->LIFNR }}</td>
            <td>{{ $row->KUNNR }}</td>
            <td>{{ $row->UMSKZ }}</td>
            <td>{{ $row->LOKKT }}</td>
            <td>{{ $row->WAERS }}</td>
            <td>{{ $row->WRBTR }}</td>
            <td>{{ $row->DMBTR }}</td>
            <td>{{ $row->DMBE2 }}</td>
            <td>{{ (substr($row->WRBTR, 0,1) == '-') ? 'H' : 'S' }}</td>
            <td>{{ $row->RCOMP }}</td>
            <td>{{ $row->BEWAR }}</td>
            <td>{{ $row->PS_POSID }}</td>
            <td>{{ $row->AUFNR }}</td>
            <td>{{ $row->KOSTL }}</td>
            <td>{{ $row->PRCTR }}</td>
            <td>{{ $row->PPRCT }}</td>
            <td>{{ $row->KKBER }}</td>
            <td>{{ $row->FILKD }}</td>
            <td>{{ (string) $row->BUPLA }}</td>
            <td>{{ $row->SECCO }}</td>
            <td>{{ $row->LSTAR }}</td>
            <td>{{ $row->FKBER }}</td>
            <td>{{ $row->ZZONE }}</td>
            <td>{{ $row->MWSKZ }}</td>
            <td>{{ $row->WMWST }}</td>
            <td>{{ $row->MWSTS }}</td>
            <td>{{ $row->FWBAS }}</td>
            <td>{{ $row->HWBAS }}</td>
            <td>{{ $row->WITHT }}</td>
            <td>{{ $row->WT_WITHCD }}</td>
            <td>{{ $row->WT_QSSHH }}</td>
            <td>{{ $row->WT_QSSHB }}</td>
            <td>{{ $row->WT_QSSH2 }}</td>
            <td>{{ $row->WT_QBSHH }}</td>
            <td>{{ $row->WT_QBSHH_DC }}</td>
            <td>{{ $row->WT_QBSH2 }}</td>
            <td>{{ $row->ZFBDT }}</td>
            <td>{{ $row->ZTERM }}</td>
            <td>{{ $row->ZBD1T }}</td>
            <td>{{ $row->ZBD2T }}</td>
            <td>{{ $row->ZBD3T }}</td>
            <td>{{ $row->ZBD1P }}</td>
            <td>{{ $row->ZBD2P }}</td>
            <td>{{ $row->SKFBT }}</td>
            <td>{{ $row->SKNTO }}</td>
            <td>{{ $row->HBKID }}</td>
            <td>{{ $row->HKTID }}</td>
            <td>{{ $row->BVTYP }}</td>
            <td>{{ $row->ZLSCH }}</td>
            <td>{{ $row->UZAWE }}</td>
            <td>{{ $row->ZLSPR }}</td>
            <td>{{ $row->DTWS1 }}</td>
            <td>{{ $row->DTWS2 }}</td>
            <td>{{ $row->DTWS3 }}</td>
            <td>{{ $row->DTWS4 }}</td>
            <td>{{ $row->INVFO_PYCUR }}</td>
            <td>{{ $row->INVFO_PYAMT }}</td>
            <td>{{ $row->ALT_PAYEE }}</td>
            <td>{{ $row->ALT_PAYEE_BANK }}</td>
            <td>{{ $row->KIDNO }}</td>
            <td>{{ $row->ZUONR }}</td>
            <td>{{ $row->SGTXT }}</td>
            <td>{{ $row->MATNR }}</td>
            <td>{{ $row->MEINS }}</td>
            <td>{{ $row->MENGE }}</td>
            <td>{{ $row->XREF1 }}</td>
            <td>{{ $row->XREF2 }}</td>
            <td>{{ $row->XREF3 }}</td>
            <td>{{ $row->KNDNR }}</td>
            <td>{{ $row->VTWEG }}</td>
            <td>{{ $row->SPART }}</td>
            <td>{{ $row->WERKS }}</td>
            <td>{{ $row->ARTNR }}</td>
            <td>{{ $row->PRCTR1 }}</td>
            <td>{{ $row->VKORG }}</td>
            <td>{{ $row->SEGMENT }}</td>
            <td>{{ $row->KUNRE }}</td>
            <td>{{ $row->KUNWE }}</td>
            <td>{{ $row->KUNRG }}</td>
            <td>{{ $row->PRDHA }}</td>
            <td>{{ $row->PAPH1 }}</td>
            <td>{{ $row->PAPH2 }}</td>
            <td>{{ $row->PAPH3 }}</td>
            <td>{{ $row->PAPH4 }}</td>
            <td>{{ $row->PAPH5 }}</td>
            <td>{{ $row->PAPH6 }}</td>
            <td>{{ $row->PAPH7 }}</td>
            <td>{{ $row->PAPH8 }}</td>
            <td>{{ $row->MTART }}</td>
            <td>{{ $row->MATKL }}</td>
            <td>{{ $row->MVGR1 }}</td>
            <td>{{ $row->MVGR2 }}</td>
            <td>{{ $row->MVGR3 }}</td>
            <td>{{ $row->KDGRP }}</td>
            <td>{{ $row->KVGR1 }}</td>
            <td>{{ $row->KVGR2 }}</td>
            <td>{{ $row->KVGR3 }}</td>
            <td>{{ $row->KVGR4 }}</td>
            <td>{{ $row->REGIO }}</td>
            <td>{{ $row->VKGRP }}</td>
            <td>{{ $row->VKBUR }}</td>
            <td>{{ $row->WW001 }}</td>
            <td>{{ $row->AUART }}</td>
            <td>{{ $row->CHARG }}</td>
            <td>{{ $row->KMLAND }}</td>
            <td>{{ $row->VBUND }}</td>
            <td>{{ $row->ZEIFO }}</td>
            <td>{{ $row->KDAUF }}</td>
            <td>{{ $row->KDPOS }}</td>
            <td>{{ $row->WW003_PA }}</td>
        </tr>
        @endforeach
    </tbody>
</table>







