<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class AllUserTransformers extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'presence',
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'nip' => $user->nip ?? "",
            'name' => $user->name,
            'rank' => optional($user->golongan)->rank,
            'group' => optional($user->golongan)->group,
            'status' => $user->status,
            'department' => $user->departemen->name,
            'position' => $user->position,
            'phone' => $user->phone ?? "",
            'email' => $user->email ?? "",
        ];
    }

    public function includePresence(User $user)
    {
        return $this->collection($user->presensi()->today()->get(), new AttendeTransformers);
    }
}
