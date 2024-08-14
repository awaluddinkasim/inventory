<x-layout title="Edit User">
    <h4 class="fw-bold py-3 mb-4">My Profile</h4>
    <div class="row">
        <div class="col-lg-6 d-none d-lg-block">
            <img src="{{ asset('assets/img/illustrations/user-form.svg') }}" alt="">
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('profile-update') }}" method="POST" autocomplete="off">
                        @csrf
                        @method('PATCH')
                        <x-form.input value="{{ auth()->user()->name }}" label="Name" name="name" id="nameInput"
                            :required="true" />
                        <x-form.input value="{{ auth()->user()->email }}" type="email" label="Email" name="email"
                            id="emailInput" :required="true" />
                        <x-form.input label="Password" name="password" type="password" id="passwordInput"
                            helperText="If you don't want to change password, leave it blank" />
                        <x-form.input value="{{ auth()->user()->phone }}" label="Phone Number" type="tel"
                            name="phone" id="phoneInput" :required="true" />

                        <x-component.button label="Save Changes" :block="true" type="submit" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
