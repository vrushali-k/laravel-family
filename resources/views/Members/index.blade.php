@extends('layouts.app')

@section('title', 'Members List')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Members List</h2>
    <a href="{{ route('members.create') }}" class="btn btn-primary">Add Member</a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Name</th>
            <th>Date of Birth</th>
            <th>Mobile No</th>
            <th>City</th>
            <th>Marital Status</th>
            <th>Photo</th>
			<th>Total members</th>
           <!-- <th>Actions</th>-->
        </tr>
    </thead>
    <tbody>
        @foreach($members as $member)<? print_r($member);?>
        <tr>
            <td>{{ $member->name }} {{ $member->sirname }}</td>
            <td>{{ date('d/m/Y',strtotime($member->dob)) }}</td>
            <td>{{ $member->mobile_no }}</td>
            <td>{{ $member->city }}</td>
            <td>{{ $member->marital_status }}</td>
            <td>
                @if($member->photo)
                    <img src="{{ asset('storage/'.$member->photo) }}" width="50" height="50" class="rounded-circle">
                @endif
            </td>
			<td> <a href="{{ route('members.show', $member->id) }}">{{ count($member->memberDetails) }}</a></td>
            <!--<td>
                <a href="{{ route('members.edit', $member->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('members.destroy', $member->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>-->
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
