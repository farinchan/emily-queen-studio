<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Search filter
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('position', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status') && $request->status !== 'all') {
            match ($request->status) {
                'show'  => $query->where('is_show', true),
                'hide' => $query->where('is_show', false),
                default   => null
            };
        }

        // Sort
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        $allowedSorts = ['name', 'email', 'position', 'created_at'];
        if (in_array($sort, $allowedSorts)) {
            $query->orderBy($sort, $direction);
        }

        $users = $query->paginate(10)->withQueryString();

        $data = [
            'title' => 'Pengguna',
            'subtitle' => 'Pengguna dan Hak Akses',
            'users' => $users,
            'roles' => Role::all(),
            'filters' => [
                'q' => $request->q,
                'status' => $request->status ?? 'all',
                'sort' => $sort,
                'direction' => $direction,
            ],
        ];

        return view('admin.pages.users', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'password'    => ['required', 'string', 'min:8', 'confirmed'],
            'position'    => 'nullable|string|max:255',
            'order'       => 'nullable|integer',
            'image'       => 'nullable|image|max:2048',
            'instagram'   => 'nullable|string|max:255',
            'about'       => 'nullable|string',
            'roles'       => 'required|array|min:1',
            'roles.*'     => 'exists:roles,name',
            'is_show'     => 'boolean',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        $user = User::create([
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'password'   => bcrypt($request->input('password')),
            'position'   => $request->input('position'),
            'order'      => $request->input('order'),
            'instagram'  => $request->input('instagram'),
            'about'      => $request->input('about'),
            'is_show'    => (bool) ($request->input('is_show') ?? false),
        ]);

        if ($request->hasFile('image')) {
            $user->image = $request->file('image')->store('users', 'public');
            $user->save();
        }

        $user->syncRoles($request->input('roles'));

        return back()->with('success', 'User created successfully.');
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email,' . $user->id,
            'password'    => ['nullable', 'string', 'min:8', 'confirmed'],
            'position'    => 'nullable|string|max:255',
            'order'       => 'nullable|integer',
            'image'       => 'nullable|image|max:2048',
            'instagram'   => 'nullable|string|max:255',
            'about'       => 'nullable|string',
            'roles'       => 'required|array|min:1',
            'roles.*'     => 'exists:roles,name',
            'is_show'     => 'boolean',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        $updateData = [
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'position'   => $request->input('position'),
            'order'      => $request->input('order'),
            'instagram'  => $request->input('instagram'),
            'about'      => $request->input('about'),
            'is_show'    => (bool) ($request->input('is_show') ?? false),
        ];

        if (!empty($validated['password'])) {
            $updateData['password'] = bcrypt($validated['password']);
        }

        $user->update($updateData);

        if ($request->hasFile('image')) {
            // Delete old image from storage
            if ($user->getOriginal('image')) {
                Storage::disk('public')->delete($user->getOriginal('image'));
            }
            $user->image = $request->file('image')->store('users', 'public');
        }

        $user->syncRoles($validated['roles']);

        return back()->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);
        if (is_string($ids)) {
            $ids = array_filter(array_map('intval', explode(',', $ids)));
        }
        User::whereIn('id', $ids)->delete();
        return back()->with('success', count($ids) . ' user(s) deleted successfully.');
    }
}
