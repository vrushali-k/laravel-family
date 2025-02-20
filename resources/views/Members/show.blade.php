@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $member->name }} - Member Details</h2>
	<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Name</th>
            <th>Date of Birth</th>
            <th>Marital Status</th>
			<th>Education</th>
            <th>Photo</th>
        </tr>
    </thead>
    <tbody>
        @foreach($member->memberDetails as $details)<? print_r($member);?>
        <tr>
            <td>{{ $details->name }}</td>
            <td>{{ date('d/m/Y',strtotime($details->dob)) }}</td>
			<td>{{ $details->marital_status }}</td>
            <td>{{ $details->education }}</td>
            
            <td>
                @if($details->photo)
                    <img src="{{ asset('storage/'.$details->photo) }}" width="50" height="50" class="rounded-circle">
                @endif
            </td>
			
        </tr>
        @endforeach
    </tbody>
</table>
    <a href="{{ route('members.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection