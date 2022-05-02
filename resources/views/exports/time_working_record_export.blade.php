<table>
    <thead>
        <tr>
            <th>SCO</th>
            <th>SID</th>
            <th>SDTE</th>
            <th>STME</th>
            <th>SMNO</th>
            <th>STY</th>
            <th>SFAG</th>
        </tr>
    </thead>
    <tbody>
        @if (!empty($data))
            @foreach ($data as $row)
                <tr>
                    <td>{{ $row->SCO }} </td>
                    <td>{{ $row->SID }} </td>
                    <td>{{ $row->SDTE }} </td>
                    <td>{{ $row->STME }} </td>
                    <td>{{ $row->SMNO }} </td>
                    <td>{{ $row->STY }} </td>
                    <td>{{ $row->SFAG }} </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
