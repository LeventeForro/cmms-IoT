<?php

namespace App\Policies;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeedbackPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'karbantartó', 'gépkezelő']);
    }

    public function view(User $user, Feedback $feedback): bool
    {
        return $user->hasAnyRole(['admin', 'karbantartó', 'gépkezelő']);
    }

    public function create(User $user): bool
    {
        return $user->hasRole('gépkezelő'); // csak operátor hozhat létre új értékelést
    }

    public function update(User $user, Feedback $feedback): bool
    {
        return false; // senki ne tudjon értékelést módosítani
    }

    public function delete(User $user, Feedback $feedback): bool
    {
        return false; // senki ne tudjon törölni
    }

    public function restore(User $user, Feedback $feedback): bool
    {
        return false;
    }

    public function forceDelete(User $user, Feedback $feedback): bool
    {
        return false;
    }

}
