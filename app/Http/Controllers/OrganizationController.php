<?php

namespace App\Http\Controllers;

use App\Models\Organization; // <-- Garanta que o Model está sendo importado
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Exibe o perfil de uma organização específica.
     */
    public function show(Organization $organization)
    {
        $organization->load('members', 'owner');

        return view('organizations.show', [
            'organization' => $organization
        ]);
    }
}