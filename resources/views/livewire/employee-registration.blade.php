<div class="m-t-30">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Set Role</h3>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-7">
                            <label for="role_id">Select a Role</label>
                            <select class="form-control" wire:model="role_id" name="role_id" id="role_id"
                                wire:change="updateForm">
                                <option value="">Select a Role</option>
                                <option value="1">Admin</option>
                                <option value="2">Evaluator</option>
                                <option value="3">Approver</option>
                                <option value="4">Employee</option>
                                <option value="5">HR</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            @if ($role_id == 1 && !$formSubmitted)
                                <div class="m-t-30">
                                    <h5>Admin Form</h5>

                                    <form wire:submit.prevent="saveFormRole">
                                        <div class="form-group">
                                            <label for="employeeId2">Employee ID</label>
                                            <input wire:model="employeeId2" type="text" name="employeeId2"
                                                id="employeeId2" class="form-control" value="{{ $employeeId2 }}"
                                                readonly>

                                        </div>
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input wire:model="first_name" type="text" name="first_name"
                                                id="first_name" class="form-control" value="{{ $first_name }}"
                                                readonly>

                                        </div>

                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input wire:model="last_name" type="text" name="last_name" id="last_name"
                                                class="form-control" value="{{ $last_name }}" readonly>

                                        </div>
                                        <button type="submit" class="btn btn-primary">Set Admin Credentials</button>
                                    </form>
                                </div>
                            @elseif ($role_id == 2 && !$formSubmitted)
                                <div class="m-t-30">
                                    <h5>Evaluator Form</h5>
                                    <form wire:submit.prevent="saveFormRole">
                                        <div class="form-group">
                                            <label for="employeeId">Employee ID</label>
                                            <input wire:model="employeeId2" type="text" name="employeeId2"
                                                id="employeeId2" class="form-control" value="{{ $employeeId2 }}"
                                                readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="bu_id">Business Unit</label>
                                            <select wire:model="bu_id" name="bu_id" id="bu_id"
                                                class="form-control">
                                                <option value="">Select a Business Unit</option>
                                                @foreach ($businessUnits as $businessUnit)
                                                    <option value="{{ $businessUnit->id }}">{{ $businessUnit->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('bu_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="department_id">Department</label>
                                            <select wire:model="department_id" name="department_id" id="department_id"
                                                class="form-control">
                                                <option value="">Select a Department</option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}">{{ $department->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('department_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input wire:model="first_name" type="text" name="first_name"
                                                id="first_name" class="form-control" value="{{ $first_name }}"
                                                readonly>

                                        </div>
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input wire:model="last_name" type="text" name="last_name" id="last_name"
                                                class="form-control" value="{{ $last_name }}" readonly>

                                        </div>
                                        <div class="form-group">
                                            <label for="position">Position</label>
                                            <input wire:model="position" type="text" name="position" id="position"
                                                class="form-control">
                                            @error('position')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="contact_no">Contact Number</label>
                                            <input wire:model="contact_no" type="text" name="contact_no"
                                                id="contact_no" class="form-control">
                                            @error('contact_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save Evaluator</button>
                                    </form>
                                </div>
                            @elseif ($role_id == 3 && !$formSubmitted)
                                <div class="m-t-30">
                                    <h5>Approver Form</h5>
                                    <form wire:submit.prevent="saveFormRole">
                                        <div class="form-group">
                                            <label for="employeeId2">Employee ID</label>
                                            <input wire:model="employeeId2" type="text" name="employeeId2"
                                                id="employeeId2" class="form-control" value="{{ $employeeId2 }}"
                                                readonly>
                                            @error('employeeId2')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="bu_id">Business Unit</label>
                                            <select wire:model="bu_id" name="bu_id" id="bu_id"
                                                class="form-control">
                                                <option value="">Select a Business Unit</option>
                                                @foreach ($businessUnits as $businessUnit)
                                                    <option value="{{ $businessUnit->id }}">{{ $businessUnit->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('bu_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input wire:model="first_name" type="text" name="first_name"
                                                id="first_name" class="form-control" value="{{ $first_name }}"
                                                readonly>
                                            @error('first_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input wire:model="last_name" type="text" name="last_name"
                                                id="last_name" class="form-control" value="{{ $last_name }}"
                                                readonly>
                                            @error('last_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="position">Position</label>
                                            <input wire:model="position" type="text" name="position"
                                                id="position" class="form-control">
                                            @error('position')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="contact_no">Contact Number</label>
                                            <input wire:model="contact_no" type="text" name="contact_no"
                                                id="contact_no" class="form-control">
                                            @error('contact_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save Approver</button>
                                    </form>
                                </div>
                            @elseif ($role_id == 4 && !$formSubmitted)
                                <div class="m-t-30">
                                    <h5>Employee Form</h5>

                                    <form wire:submit.prevent="saveFormRole">
                                        <div class="form-group">
                                            <label for="employeeId2">Employee ID</label>
                                            <input wire:model="employeeId2" type="text" name="employeeId2"
                                                id="employeeId2" class="form-control" value="{{ $employeeId2 }}"
                                                readonly>
                                            @error('employeeId2')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input wire:model="first_name" type="text" name="first_name"
                                                id="first_name" class="form-control" value="{{ $first_name }}"
                                                readonly>
                                            @error('first_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input wire:model="last_name" type="text" name="last_name"
                                                id="last_name" class="form-control" value="{{ $last_name }}"
                                                readonly>
                                            @error('last_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Set Employee
                                            Credentials</button>
                                    </form>
                                </div>
                            @elseif ($role_id == 5 && !$formSubmitted)
                                <div class="m-t-30">
                                    <h5>HR Form</h5>
                                    <form wire:submit.prevent="saveFormRole">
                                        <div class="form-group">
                                            <label for="employeeId2">Employee ID</label>
                                            <input wire:model="employeeId2" type="text" name="employeeId2"
                                                id="employeeId2" class="form-control" value="{{ $employeeId2 }}"
                                                readonly>
                                            @error('employeeId')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input wire:model="first_name" type="text" name="first_name"
                                                id="first_name" class="form-control" value="{{ $first_name }}"
                                                readonly>
                                            @error('first_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input wire:model="last_name" type="text" name="last_name"
                                                id="last_name" class="form-control" value="{{ $last_name }}"
                                                readonly>
                                            @error('last_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="position">Position</label>
                                            <input wire:model="position" type="text" name="position"
                                                id="position" class="form-control">
                                            @error('position')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="contact_no">Contact Number</label>
                                            <input wire:model="contact_no" type="text" name="contact_no"
                                                id="contact_no" class="form-control">
                                            @error('contact_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save HR</button>
                                    </form>
                                </div>
                            @elseif ($formSubmitted)
                                <div class="m-t-30">
                                    <h5>User Credentials</h5>
                                    <form wire:submit.prevent="register">
                                        <!-- Your registration form fields -->
                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input wire:model="email" type="email" name="email" id="email"
                                                class="form-control">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input wire:model="password" type="password" name="password"
                                                id="password" class="form-control">
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="password_confirmation">Confirm Password</label>
                                            <input wire:model="passwordConfirmation" type="password"
                                                name="passwordConfirmation" id="passwordConfirmation"
                                                class="form-control">
                                            @error('passwordConfirmation')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Register</button>
                                    </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
