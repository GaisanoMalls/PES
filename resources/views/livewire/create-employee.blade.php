<form wire:submit.prevent="store">
    @csrf
    <div class="form-group">
        <label for="employee_id">Employee ID</label>
        <input wire:model="employee_id" type="text" name="employee_id" id="employee_id" class="form-control">
        @error('employee_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror

    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="first_name">First Name</label>
            <input wire:model="first_name" type="text" name="first_name" id="first_name" class="form-control">
            @error('first_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="last_name">Last Name</label>
            <input wire:model="last_name" type="text" name="last_name" id="last_name" class="form-control">
            @error('last_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input wire:model="email" type="email" name="email" id="email" class="form-control">
        @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="phone_number">Phone Number</label>
        <input wire:model="phone_number" type="text" name="phone_number" id="phone_number" class="form-control">
        @error('phone_number')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="role">Role</label>
        <select wire:model="role" name="role" id="role" class="form-control">
            <option value="">Select Role</option>
            <optgroup label="ICT Department">
                <option value="Software Engineer">Software Engineer</option>
                <option value="Network Engineer">Network Engineer</option>
                <option value="System Administrator">System Administrator</option>
                <option value="IT Support Specialist">IT Support Specialist</option>
                <option value="Web Developer">Web Developer</option>
            </optgroup>
        </select>
        @error('role')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="join_date">Join Date</label>
        <input class="form-control" type="date" wire:model="join_date" id="join_date-select" name="join_date-select"
            required>

        @error('join_date')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</form>
