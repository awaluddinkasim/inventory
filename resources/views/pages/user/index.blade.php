<x-layout>
    <div class="card">
        <div class="card-body">
            <x-form.modal label="tambahData" title="users" action="{{ route('users.store') }}">
                <x-form.input label="name" name="name" id="name" :required="true" />
                <x-form.input label="email" name="email" id="email" :required="true" />
                <x-form.input label="password" name="password" type="password" id="password" :required="true" />
                <x-form.input label="phone" type="tel" name="phone" id="phone" :required="true" />
                <x-form.select label="role" id="role" name="role" :required="true">
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </x-form.select>
            </x-form.modal>
            <x-component.datatable id="userTable">
                <thead>

                        <th>#</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th></th>

                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->role }}</td>


                                <td class="text-center">
                                    <x-component.button label="Edit"
                                        href="{{ route('users.edit', $user->id) }}" />
                                    <form
                                        action="{{ route('users.destroy', $user->id) }}"
                                        class="d-inline" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <x-component.button type="submit" label="Hapus" color="danger" />
                                    </form>
                                </td>

                        </tr>
                    @endforeach
                </tbody>
            </x-component.datatable>
        </div>
    </div>

</x-layout>
