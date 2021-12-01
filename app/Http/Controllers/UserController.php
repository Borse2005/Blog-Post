<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Image;
use App\Models\User;
use App\Services\counter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public $counter;

    public function __construct(counter $counter)
    {
        $this->middleware('auth');
        // $this->authorizeResource(User::class, 'user');
        $this->counter = $counter;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
    //    $counter = resolve(counter::class);
        return view('users.show', [
            'user' => $user,
            'counter' => $this->counter->increament($user->id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->name = $request->get('name');
        $user->locale = $request->get('locale');
        $user->save();

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars');
            if ($user->images) {
                Storage::delete($user->images->path);
                $user->images->path = $path;
                $user->images->save();
            }else{
                $user->images()->save(
                    Image::make([
                        'path' => $path,
                    ])
                );
            }
        }

        return redirect()->route('user.show', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
