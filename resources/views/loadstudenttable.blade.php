@foreach($students as $key => $student)
<tr>
    <th scope="row">{{ $key + 1 }}</th>
    <td>{{ $student->name }}</td>
    <td>{{ $student->email }}</td>
    <td>{{ $student->department }}</td>
    <td>{{ $student->roll_no }}</td>
    <td>{{ $student->batch }}</td>
</tr>
@endforeach