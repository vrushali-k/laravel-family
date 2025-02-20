@extends('layouts.app')

@section('title', 'Add Member with Details')

@section('content')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Add New Member with Family Details</h3>
        </div>
		<!-- Display Validation Errors -->
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

        <div class="card-body">
            <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <h4>Member Information</h4>
				<div class='row'>
					<div class="col-md-6">
						 <label for="name" class="form-label">Name</label>
						<input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
						@error('name') <span class="text-danger">{{ $message }}</span> @enderror
					</div>
					<div class="col-md-6">
						<label for="sirname" class="form-label">Surname</label>
						<input type="text" id="sirname" name="sirname" class="form-control @error('sirname') is-invalid @enderror" value="{{ old('sirname') }}" required>
						@error('sirname') <span class="text-danger">{{ $message }}</span> @enderror
					</div>
				</div>
				<div class='row'>
					<div class="col-md-6">
						<label for="dob" class="form-label">Date of Birth</label>
						<input type="date" id="dob" name="dob" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob') }}">
						@error('dob') <span class="text-danger">{{ $message }}</span> @enderror
					</div>
					<div class="col-md-6">
						<label for="mobile_no" class="form-label">Mobile Number</label>
						<input type="text" id="mobile_no" name="mobile_no" class="form-control @error('mobile_no') is-invalid @enderror" value="{{ old('mobile_no') }}">
						@error('mobile_no') <span class="text-danger">{{ $message }}</span> @enderror
					</div>
				</div>
				<div class='row'>
					<div class="col-md-4">
						<label class="form-label">Address</label>
						<textarea name="address" class="form-control @error('address') is-invalid @enderror"  value="{{ old('address') }}" required></textarea>
						@error('address') <span class="text-danger">{{ $message }}</span> @enderror
					</div>
					 <div class="col-md-3">
						<label for="state_id" class="form-label">State</label>
						<select id="state_id" name="state_id" class="form-control">
							<option value="">Select State</option>
							@foreach($states as $state)
								<option value="{{ $state->id }}" {{ old('state_id') == $state->id ? 'selected' : '' }}>{{ $state->state }}</option>
							@endforeach
						</select>
						@error('state_id') <span class="text-danger">{{ $message }}</span> @enderror
					</div>
					 <div class="col-md-3">
						<label for="city_id" class="form-label">City</label>
						<select id="city_id" name="city_id" class="form-control">
							<option value="">Select City</option>
						</select>
						@error('city_id') <span class="text-danger">{{ $message }}</span> @enderror
					</div>
					<div class="col-md-2">
						<label class="form-label">Pin code</label>
						<input type="text" name="pin_code" value="{{ old('pin_code') }}" class="form-control @error('pin_code') is-invalid @enderror" required>
						@error('pin_code') <span class="text-danger">{{ $message }}</span> @enderror
					</div>
				</div>
				<div class='row'>
					<div class="col-md-4">
						<label class="form-label">Marital Status</label>
						<select name="marital_status" class="form-control" id='marital_status' onChange='getWeddingDate();'>
							<option value="">Choose one</option>
							<option value="Single" {{ old('marital_status') == 'Single' ? 'selected' : '' }} >Single</option>
							<option value="Married" {{ old('marital_status') == 'Married' ? 'selected' : '' }}>Married</option>
						</select>
						@error('marital_status') <span class="text-danger">{{ $message }}</span> @enderror
					</div>
					<div class="col-md-4 weddingDate" style='display:none'>
						<label class="form-label">Wedding Date</label>
						<input type="date" id="wedding_date" name="wedding_date" class="form-control @error('wedding_date') is-invalid @enderror" value="{{ old('wedding_date') }}">
						@error('wedding_date') <span class="text-danger">{{ $message }}</span> @enderror
					</div>
					<div class="col-md-4">
						<label class="form-label">Photo</label>
						<input type="file" name="photo" class="form-control">
					</div>
				</div>
                <hr>

                <h4>Family Members</h4>
                <div id="family-members">
                    <div class="family-member mb-3">
						<div class="row">
							<div class="col-md-1">&nbsp;</div>
							<div class="col-md-2">Name</div>
							<div class="col-md-2">Date of birth</div>
							<div class="col-md-1">Marital Status</div>
							<div class="col-md-2 weddingHead" style='display:none'>Wedding Date</div>
							<div class="col-md-2">Education</div>
							<div class="col-md-2">Photo</div>
						</div>
                        <div class="row">
							<div class="col-md-1">
								<button type="button" class="btn btn-secondary " id="add-member">+</button>
							</div>
                            <div class="col-md-2">
                                <input type="text" name="member_details[0][name]" class="form-control"  required>
                            </div>
                            <div class="col-md-2">
                                <input type="date" name="member_details[0][dob]" class="form-control" required>
                            </div>
                            <div class="col-md-1">
                                <select name="member_details[0][marital_status]" class="form-control" onChange="addWeddingDate(0)" id='marital_status_0'>
									<option value="">Choose one</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                </select>
                            </div>
							<div class="col-md-2" style='display:none' id='wedding_date_0'>
                                <input type="date" name="member_details[0][wedding_date]" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="member_details[0][education]" class="form-control" placeholder="Education" required>
                            </div>
                            <div class="col-md-2">
                                <input type="file" name="member_details[0][photo]" class="form-control">
                            </div>
							
                        </div>
                    </div>
                </div>

				<hr>
                <h4>Hobbies</h4>

                <!-- Dynamic Hobby Input -->
                <h5>Add More Hobbies</h5>
                <div id="hobby-list">
                    <div class="input-group mb-3">
						<button type="button" class="btn btn-secondary" id="add-hobby">+</button>
                        <input type="text" name="hobbies[]" class="form-control" placeholder="Enter a hobby">
                    </div>
                </div>

                <hr>
                <button type="submit" class="btn btn-success mt-3">Save</button>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        let memberIndex = 1;

        $('#add-member').click(function () {
            let memberHTML = '<div class="family-member mb-3">';
                memberHTML +=  '<div class="row">';
				memberHTML +=  '<div class="col-md-1">';
				memberHTML +=  '<button type="button" class="btn btn-danger remove-member">-</button>';
				memberHTML +=  '</div>';
                memberHTML +=  '<div class="col-md-2">';
                memberHTML +=  '<input type="text" name="member_details[\${memberIndex}][name]" class="form-control" required>';
                memberHTML +=  '</div>';
                memberHTML +=  '<div class="col-md-2">';
                memberHTML +=  '<input type="date" name="member_details[\${memberIndex}][dob]" class="form-control" required>';
                memberHTML +=  '</div>';
                memberHTML +=  '<div class="col-md-1">';
                memberHTML +=  '<select name="member_details[\${memberIndex}][marital_status]" class="form-control" onChange="addWeddingDate('+memberIndex+')" id="marital_status_'+memberIndex+'">';
				memberHTML +=  '<option value="">Choose one</option>';
                memberHTML +=  '<option value="Single">Single</option>';
                memberHTML +=  '<option value="Married">Married</option>';
                memberHTML +=  '</select>';
                memberHTML +=  '</div>';
				memberHTML +=  '<div class="col-md-2" style="display:none" id="wedding_date_'+memberIndex+'">';
                memberHTML +=  '<input type="date" name="member_details[\${memberIndex}][wedding_date]" class="form-control">';
                memberHTML +=  '</div>';
                memberHTML +=  '<div class="col-md-2">';
                memberHTML +=  '<input type="text" name="member_details[\${memberIndex}][education]" class="form-control" placeholder="Education" required>';
                memberHTML +=  '</div>';
                memberHTML +=  '<div class="col-md-2">';
                memberHTML +=  '<input type="file" name="member_details[\${memberIndex}][photo]" class="form-control">';
                memberHTML +=  '</div>';
                memberHTML +=  '</div>';
                memberHTML +=  '</div>';
         

            $('#family-members').append(memberHTML);
            memberIndex++;
        });

        $(document).on('click', '.remove-member', function () {
            $(this).closest('.family-member').remove();
        });
		
		$("#add-hobby").click(function () {
            let hobbyInput = '<div class="input-group mb-3">';
            hobbyInput += '<input type="text" name="hobbies[]" class="form-control" placeholder="Enter a hobby">';
            hobbyInput += '<button type="button" class="btn btn-danger remove-hobby">Remove</button>';
            hobbyInput +=  '</div>';
   
            $("#hobby-list").append(hobbyInput);
        });

        $(document).on("click", ".remove-hobby", function () {
            $(this).parent().remove();
        });
		
		$('#state_id').change(function () {
            var stateID = $(this).val();
            if (stateID) {
				var selectedCityId = "{{ old('city_id') }}"; // Get previously selected city
                $.ajax({
                    url: '/get-cities/' + stateID,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#city_id').empty().append('<option value="">Select City</option>');
                        $.each(data, function (key, value) {
                            let selected = selectedCityId == value.id ? 'selected' : '';
                            $('#city_id').append('<option value="' + value.id + '" ' + selected + '>' + value.city + '</option>');
                        });
                    }
                });
            } else {
                $('#city_id').empty().append('<option value="">Select City</option>');
            }
        });
		$('#state_id').trigger('change');
		
    });
	
	function addWeddingDate(val) {
		if($("#marital_status_"+val).val() != '') {
			if($("#marital_status_"+val).val() == 'Married') {
				$("#wedding_date_"+val).show();
			} else {
				$("#wedding_date_"+val).hide();
			}
		} else {
			$("#wedding_date_"+val).hide();
		}
	}
	
	function getWeddingDate() {
		if($('#marital_status').val() != '') {
			if($('#marital_status').val()=='Married') {
				$('.weddingDate').show();
			} else {
				$('.weddingDate').hide();
			}
		} else {
			$('.weddingDate').hide();
		}
	}	
</script>
@endsection
