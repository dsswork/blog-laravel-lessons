<x-admin.layout title="Edit User">
    <form action="{{ route('admin.users.update', compact('user')) }}"
          method="post"
          class="col-md-6">
        @csrf
        @method('put')
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Edit User</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="email" value="{{ $user->email }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Role</label>
                    <select name="role" id="" class="form-control">
                        @foreach(\App\Enums\UserRoleEnum::cases() as $role)
                            <option
                                @selected($user->role->value === $role->value)
                                value="{{ $role->value }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
       <x-admin.buttons.save-delete />
    </form>
</x-admin.layout>

<x-admin.modals.delete :model="$user" />
