<x-layout title="Edit Member">
    <div class="row">
        <div class="col-lg-6 d-none d-lg-block">
            <img src="{{ asset('assets/img/illustrations/server.svg') }}" alt="">
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Edit Member</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.members.update', $user->id) }}" method="POST" autocomplete="off">
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
                        <x-form.textarea label="Address" id="address" name="address" :rows="5" readonly=""
                            required="true">{{ $user->address }}</x-form.textarea>


                        <x-component.button label="Save Changes" :block="true" type="submit" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
