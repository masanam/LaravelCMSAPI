<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

use Illuminate\Support\Facades\Hash;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param UserDataTable $userDataTable
     * @return Response
     */
    public function index(UserDataTable $userDataTable)
    {
        return $userDataTable->render('users.index');
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        $permissions = \App\Models\Permission::all();
        $roles = \App\Models\Role::all();

        // edited by dandisy
        // return view('users.create');
        return view('users.create')
            ->with('permissions', $permissions)
            ->with('roles', $roles);
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();

        $permissions = null;
        if(isset($input['permissions'])) {
            $permissions = $input['permissions'];
            unset($input['permissions']);
        }
        $roles = null;
        if(isset($input['roles'])) {
            $roles = $input['roles'];
            unset($input['roles']);
        }

        $input['password'] =  Hash::make($input['password']);

        $user = $this->userRepository->create($input);

        if($user) {
            $user = \App\User::find($user->id);

            if($permissions) {
                $user->syncPermissions($permissions);
            }
            if($roles) {
                $user->syncRoles($roles);
            }
        }

        Flash::success('User saved successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        // $user = $this->userRepository->findWithoutFail($id);
        $user = $this->userRepository
            ->select(['id', 'name', 'email', 'email_verified_at', 'notif_token', 'is_admin', 'created_at', 'updated_at'])
            ->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        $permissions = \App\Models\Permission::all();
        $roles = \App\Models\Role::all();


        // $user = $this->userRepository->findWithoutFail($id);
        $user = \App\User::select('id', 'name', 'email')->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $user['permissions'] = $user->getPermissionNames() ? : null;
        $user['roles'] = $user->getRoleNames() ? : null;

        // edited by dandisy
        // return view('users.edit')->with('user', $user);
        return view('users.edit')
            ->with('user', $user)
            ->with('permissions', $permissions)
            ->with('roles', $roles);
    }

    /**
     * Update the specified User in storage.
     *
     * @param  int              $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $input = $request->all();

        if(empty($input['password'])) {
            unset($input['password']);
        } else {
            $input['password'] =  Hash::make($input['password']);
        }

        unset($input['email']);

        $permissions = null;
        if(isset($input['permissions'])) {
            $permissions = $input['permissions'];
            unset($input['permissions']);
        }
        $roles = null;
        if(isset($input['roles'])) {
            $roles = $input['roles'];
            unset($input['roles']);
        }

        if($this->userRepository->update($input, $id)) {
            $user = \App\User::find($id);

            if($permissions) {
                $user->syncPermissions($permissions);
            }
            if($roles) {
                $user->syncRoles($roles);
            }
        }

        Flash::success('User updated successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Store data User from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $user = $this->userRepository->create($item->toArray());
            });
        });

        Flash::success('User saved successfully.');

        return redirect(route('users.index'));
    }
}
