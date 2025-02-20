<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Member;
use App\Models\MemberDetail;
use App\Models\Hobby;
use App\Models\State;
use App\Models\City;

class MemberController extends Controller
{
    /**
     * Display a listing of the members.
     */
    public function index() {
        //$members = Member::all();
		$members = Member::with('memberDetails')->get();
        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new member.
     */
    public function create() {
		$states = State::all();
        return view('members.create', compact('states'));
    }

    /**
     * Store a newly created member in the database.
     */
    public function store(Request $request) {
		DB::beginTransaction();
		try {
			$validated = $request->validate([
				'name' => 'required|string',
				'sirname' => 'required|string',
				'dob' => ['required', 'date', 'before_or_equal:' . now()->subYears(21)->format('Y-m-d')],
				'mobile_no' => 'required|string',
				'address' => 'required|string',
				 'state_id' => 'required|exists:states,id',
				 'city_id' => 'required|exists:cities,id',
				'pin_code' => 'required|string',
				'marital_status' => 'required|string',
				'wedding_date' => 'nullable|date',
				'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
				'member_details' => 'array',
				'hobbies' => 'nullable|array'
			], [
				'dob.before_or_equal' => 'You must be at least 21 years old.',
			]);

			if ($request->hasFile('photo')) {
				$validated['photo'] = $request->file('photo')->store('photos', 'public');
			}
			$member = Member::create($validated);

			if ($request->has('member_details')) {
				foreach ($request->member_details as $detail) {
					$detail['member_id'] = $member->id;

					if (isset($detail['photo'])) {
						$detail['photo'] = $detail['photo']->store('photos', 'public');
					}

					MemberDetail::create($detail);
				
				}
			}
			
			if ($request->has('hobbies')) { 
				$hobby = array();
				foreach ($request->hobbies as $i=>$detail) {
					$hobby['member_id'] = $member->id;

					if (isset($detail)) {
						$hobby['hobby'] = $detail;
					}

					Hobby::create($hobby);
				}
			}
			DB::commit();
            return redirect()->route('members.index')->with('success', 'Member added successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
	}

    /**
     * Show the form for editing a member.
     */
    public function edit(Member $member) {
        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified member in the database.
     */
    public function update(Request $request, Member $member) {
        $request->validate([
            'name' => 'required|string|max:100',
            'dob' => 'required|date',
            'marital_status' => 'required|string|max:10',
            'wedding_date' => 'date',
            'education' => 'required|string|max:50',
            'photo' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle File Upload
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('uploads/members', 'public');
            $member->photo = $photoPath;
            $member->photo_dir = 'storage/' . $photoPath;
        }

        $member->update($request->except('photo'));

        return redirect()->route('members.index')->with('success', 'Member updated successfully!');
    }

    /**
     * Remove the specified member from the database.
     */
    public function destroy(Member $member) {
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Member deleted successfully!');
    }
	
	public function show($id) {
        $member = Member::with('memberDetails')->findOrFail($id);
        return view('members.show', compact('member'));
    }
	
	public function getCities($state_id) {
        $cities = City::where('state_id', $state_id)->get();
        return response()->json($cities);
    }
}
