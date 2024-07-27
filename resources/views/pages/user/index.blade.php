<x-layout>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h5 class="card-title">Users</h5>
                <x-form.modal label="Create" title="Form User" action="{{ route('users.store') }}">
                    <x-form.input label="Name" name="name" id="nameInput" :required="true" />
                    <x-form.input label="Email" type="email" name="email" id="emailInput" :required="true" />
                    <x-form.input label="Password" name="password" type="password" id="passwordInput"
                        :required="true" />
                    <x-form.input label="Phone Number" type="tel" name="phone" id="phoneInput"
                        :required="true" />
                    <x-form.select label="role" id="roleSelect" name="role" :required="true">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </x-form.select>
                </x-form.modal>
            </div>
        </div>
        <div class="card-body">
            <x-component.datatable id="userTable">
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Role</th>
                    <th>Last Login</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ Str::ucfirst($user->role) }}</td>
                            <td>{{ $user->last_login }}</td>
                            <td class="text-center">
                                @if ($user->id != auth()->user()->id)
                                    <x-component.button label="Edit" href="{{ route('users.edit', $user->id) }}" />
                                    <form action="{{ route('users.destroy', $user->id) }}" class="d-inline"
                                        method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <x-component.button type="submit" label="Delete" color="danger" />
                                    </form>
                                @else
                                    <x-component.button type="submit" label="Delete" color="danger"
                                        :disabled="true" />
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-component.datatable>
        </div>
    </div>
</x-layout>
