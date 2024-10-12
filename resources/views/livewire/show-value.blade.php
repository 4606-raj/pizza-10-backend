<div>

    <table class="table table-responsive table-hover">
        <thead>
            <th>Sr.</th>
            <th>Name</th>
            <th>Base</th>
            <th>Quantity</th>
            <th>Description</th>
        </thead>
        <tbody>

            @if (is_array($this->value))
                @foreach ($this->value as $key => $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $value['name'] }}</td>
                        <td>{{ $value['base'] }}</td>
                        <td>{{ $value['quantity'] }}</td>
                        <td>{{ $value['description'] }}</td>
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>
</div>
