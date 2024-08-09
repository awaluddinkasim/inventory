<x-layout title="Edit User">
    <div class="row">
        <div class="col-lg-6 d-none d-lg-block">
            <img src="{{ asset('assets/img/illustrations/user-form.svg') }}" alt="">
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Edit User</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST" autocomplete="off">
                        @csrf
                        @method('PATCH')
                        <x-form.input value="{{ $user->name }}" label="Name" name="name" id="nameInput"
                            :required="true" />
                        <x-form.input value="{{ $user->email }}" type="email" label="Email" name="email"
                            id="emailInput" :required="true" />
                        <x-form.input label="Password" name="password" type="password" id="passwordInput"
                            helperText="If you don't want to change password, leave it blank" />
                        <x-form.input value="{{ $user->phone }}" label="Phone Number" type="tel" name="phone"
                            id="phoneInput" :required="true" />
                        <x-form.select label="Role" name="role" id="roleSelect" :required="true">
                            <option value="admin" @if ($user->role == 'admin') selected @endif>Admin</option>
                            <option value="operator" @if ($user->role == 'operator') selected @endif>Operator</option>
                        </x-form.select>
                        <x-component.button label="Save Changes" :block="true" type="submit" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
