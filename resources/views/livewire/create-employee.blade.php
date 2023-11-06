<div>
    @if ($successMessage)
        <div class="alert alert-success">{{ $successMessage }}</div>
    @endif

    <form wire:submit.prevent="register">
        <!-- Your registration form fields -->

        {{ $employeeId }}
        <div class="form-group">
            <label for="email">Email Address</label>
            <input wire:model="email" type="email" name="email" id="email" class="form-control">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input wire:model="password" type="password" name="password" id="password" class="form-control">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input wire:model="passwordConfirmation" type="password" name="passwordConfirmation"
                id="passwordConfirmation" class="form-control">


        </div>



        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
