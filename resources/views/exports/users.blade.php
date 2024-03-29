<table>
    <thead>
    <tr>
        <th>Sr.</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Status</th>
        <th>Address</th>
        <th>City</th>
        <th>Zip code</th>
        <th>Created Date</th>
    </tr>
    </thead>
    <tbody>
    @php $i = 1 @endphp
    @foreach($users as $key => $user)
        <tr>
            <td>{{$i++}}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->is_active == '1' ? 'Active' : 'Deactive' }}</td>
            <td>{{ $user->address }}</td>
            <td>{{ $user->city }}</td>
            <td>{{ $user->zip_code }}</td>
            <td>{{ date('Y M d',strtotime($user->created_at)) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>