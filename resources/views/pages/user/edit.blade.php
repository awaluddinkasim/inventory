<x-layout>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                    <x-form.input  :value="$user->name" label="name" name="name" id="name" :required="true" />
                    <x-form.input value="{{ $user->email }}" label="email" name="email" id="email" :required="true" />
                    <x-form.input  label="password" name="password" type="password" id="password"  />
                    <x-form.input value="{{ $user->phone }}" label="phone" type="tel" name="phone" id="phone" :required="true" />
                    <x-form.select  label="role" id="role" name="role" :required="true">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </x-form.select>
                        @csrf
                        @method('put')
                        <x-component.button label="simpan" :block="True" type="submit" />


                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">

        </div>
    </div>
</x-layout>
