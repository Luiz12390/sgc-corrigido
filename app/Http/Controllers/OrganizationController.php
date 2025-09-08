<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class OrganizationController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        return view('organizations.index');
    }

    /**
     * Exibe o perfil de uma organização específica.
     */
    public function show(Organization $organization)
    {
        $organization->load('members', 'owner', 'projects');

        return view('organizations.show', [
            'organization' => $organization
        ]);
    }

    public function manageMembers(Organization $organization)
    {
        $organization->load('joinRequests.user');

        return view('organizations.manage-members', ['organization' => $organization]);
    }

    public function members(Organization $organization)
    {
        $members = $organization->members()->paginate(12);

        return view('organizations.members', [
            'organization' => $organization,
            'members' => $members
        ]);
    }

    public function edit(Organization $organization)
    {
        $this->authorize('update', $organization);

        return view('organizations.edit', ['organization' => $organization]);
    }

    public function update(Request $request, Organization $organization)
    {
        $this->authorize('update', $organization);

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'type' => ['nullable', 'string', 'max:255'],
            'specialization_areas' => ['nullable', 'string', 'max:255'],
            'competencies' => ['nullable', 'string', 'max:255'],
            'available_resources' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('logo')) {
            if ($organization->logo_path) {
                Storage::disk('public')->delete($organization->logo_path);
            }
            $validatedData['logo_path'] = $request->file('logo')->store('organization-logos', 'public');
        }

        $organization->update($validatedData);

        return redirect()->route('organizations.show', $organization)->with('status', 'Organização atualizada com sucesso!');
    }
}
