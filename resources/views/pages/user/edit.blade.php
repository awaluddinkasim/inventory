<x-layout>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
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
                            <option value="user" @if ($user->role == 'user') selected @endif>User</option>
                        </x-form.select>
                        <x-component.button label="Save Changes" :block="true" type="submit" />
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">

        </div>
    </div>
</x-layout>
