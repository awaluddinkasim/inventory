<x-layout title="Members">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Members</h5>
            </div>
        </div>
        <div class="card-body">
            <x-component.datatable id="userTable">
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>

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
                            <td>{{ $user->last_login ?? '-' }}</td>

                            <td class="text-center">
                                <x-component.button label="Edit" href="{{ route('user.members.edit', $user->id) }}"
                                    :small="true" />
                                <form action="{{ route('user.members.destroy', $user->id) }}" class="d-inline"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <x-component.button type="submit" label="Delete" color="danger"
                                        :small="true" />
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-component.datatable>
        </div>
    </div>
</x-layout>
