<x-layout title="Admins">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Admins</h5>
                <x-form.modal label="New Admin" title="Form User" action="{{ route('user.admins.store') }}">
                    <x-form.input label="Name" name="name" id="nameInput" :required="true" />
                    <x-form.input label="Email" type="email" name="email" id="emailInput" :required="true" />
                    <x-form.input label="Password" name="password" type="password" id="passwordInput"
                        :required="true" />
                    <x-form.input label="Phone Number" type="tel" name="phone" id="phoneInput"
                        :required="true" />
                    <x-form.select label="Role" name="role" id="roleSelect" :required="true">
                        <option value="admin">Admin</option>
                        <option value="operator">Operator</option>
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
                    @foreach ($admins as $admin)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->phone }}</td>
                            <td>{{ Str::ucfirst($admin->role) }}</td>
                            <td>{{ $admin->last_login ?? '-' }}</td>
                            <td class="text-center">
                                @if ($admin->id != auth()->user()->id)
                                    <x-component.button label="Edit"
                                        href="{{ route('user.admins.edit', $admin->id) }}" :small="true" />
                                    <form action="{{ route('user.admins.destroy', $admin->id) }}" class="d-inline"
                                        method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <x-component.button type="submit" label="Delete" color="danger"
                                            :small="true" />
                                    </form>
                                @else
                                    <x-component.button type="submit" label="Delete" color="danger" :small="true"
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
