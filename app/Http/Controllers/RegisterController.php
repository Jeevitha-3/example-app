<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Register;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Repositories\RegisterRepositoryInterface;
use App\Events\UserRegistered;
use App\DTO\RegisterDTO;
use App\Services\RegisterService;
use App\Repositories\RegisterRepository;

class RegisterController extends Controller
{
    protected $registerService;
    protected $registerRepo;

    public function __construct(RegisterService $registerService, RegisterRepository $registerRepo){
        $this->registerService = $registerService;
        $this->registerRepo = $registerRepo;
    }

     public function create()
    {
        return view('registerform');
    }
    

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:77',
            'email' => 'required|email|unique:registers,email|max:191',
            'phonenumber' => 'required|string|max:15',
            'address' => 'required|string|max:175',
            'city' => 'required|string|max:190',
            'state' => 'required|string|max:90',
            'country' => 'required|string|max:90',
            'zipcode' => 'required|string|max:10',
            'role' => 'required|integer|max:190',
            'gender' => 'required|in:male,female|max:100',
            'dob' => 'required|date|max:9999-11-31',
        ]);

        $dto = new RegisterDTO($validated);
        $this->registerService->store($dto);

        return redirect()->back()->with('success', 'Registration successful!');
    }

    
    public function edit($id)
    {
        $user = Register::findOrFail($id);
        return view('register.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phonenumber' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'zipcode' => 'required',
            'role' => 'required|integer|max:191',
            'gender' => 'required|in:male,female|max:155',
            'dob' => 'required|date|max:9999-10-31',
        ]);

        $dto = new RegisterDTO($request->all());

        $user = Register::findOrFail($id);
        $user->update((array) $dto);
        return redirect()->back()->with('success', 'User updated successfully!');
    }

    public function destroy($id)
    {
        $user = Register::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully!');
    }

    public function repoCreate()
    {
        return view('registerform');
    }


    public function repoStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:77',
            'email' => 'required|email|unique:registers,email|max:191',
            'phonenumber' => 'required|string|max:15',
            'address' => 'required|string|max:175',
            'city' => 'required|string|max:65',
            'state' => 'required|string|max:55',
            'country' => 'required|string|max:5',
            'zipcode' => 'required|string|max:10',
            'role' => 'required|integer|max:191',
            'gender' => 'required|in:male,female|max:55',
            'dob' => 'required|date|max:9999-12-31',
        ]);

        $this->registerRepo->repoStore($validatedData);
        event(new UserRegistered($validatedData));

        return redirect()->route('register.create')->with('success', 'Register saved successfully');
    }

    public function repoUpdate(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:166',
                'email' => 'required|email|max:255',
                'phonenumber' => 'required|string|max:20',
                'address' => 'required|string|max:192',
                'city' => 'required|string|max:65',
                'state' => 'required|string|max:191',
                'country' => 'required|string|max:191',
                'zipcode' => 'required|string|max:20',
                'role' => 'required|string|max:50',
                'dob' => 'required|date|max:9999-12-31',
                'gender' => 'required|in:male,female|max:55',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $this->registerRepo->repoUpdate($id, $request->all());

            return response()->json(['success' => true, 'message' => 'Record updated successfully.']);
        } catch (\Exception $e) {
            Log::error("Update Error: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error updating record.']);
        }
    }

    public function repoDestroy($id)
    {
        try {
            $this->registerRepo->repoDelete($id);

            return response()->json(['success' => true, 'message' => 'Record deleted successfully.']);
        } catch (\Exception $e) {
            Log::error("Delete Error: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error deleting record.']);
        }
    }


    public function apiStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|unique:registers,email',
            'phonenumber' => 'required|digits:10',
            'address' => 'required|string|max:75',
            'city' => 'required|string|max:55',
            'state' => 'required|string',
            'country' => 'required|string',
            'zipcode' => 'required|digits:6',
            'role' => 'required|integer',
            'gender' => 'required|in:male,female',
            'dob' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $register = $this->registerRepo->repoStore($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Register saved successfully.',
                'data' => $register
            ], 201);
        } catch (\Exception $e) {
            Log::error('API Register Store Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.'
            ], 500);
        }
    }

    // API Show register
    public function show($id)
    {
        try {
            $register = $this->registerRepo->repoFind($id);
            return response()->json([
                'success' => true,
                'data' => $register
            ]);
        } catch (\Exception $e) {
            Log::error('API Show Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Register not found.'
            ], 404);
        }
    }

    // API Update register
    public function apiUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:registers,email,' . $id,
            'phonenumber' => 'required|digits:10',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:5',
            'state' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'zipcode' => 'required|digits:6',
            'role' => 'required|integer',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $register = $this->registerRepo->repoUpdate($id, $request->all());

            return response()->json([
                'success' => true,
                'message' => 'Register updated successfully.',
                'data' => $register
            ]);
        } catch (\Exception $e) {
            Log::error('API Update Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error updating register.'
            ], 500);
        }
    }

    // API Delete register
    public function apiDestroy($id)
    {
        try {
            $this->registerRepo->repoDelete($id);

            return response()->json([
                'success' => true,
                'message' => 'Register deleted successfully.'
            ]);
        } catch (\Exception $e) {
            Log::error('API Delete Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error deleting register.'
            ], 500);
        }
    }
}
