<li class="nav-label">Dashboard</li>
<li class="{{ Request::is('stats*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! url('stats') !!}"><i data-feather="activity"></i><span>Stats</span></a>
</li>

@if(Auth::user()->is_admin || Auth::user()->tenancy_id)
{{-- menu here --}}
@endif

<li class="nav-label mg-t-25">Setting</li>
<li class="{{ Request::is('sliders*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.sliders.index') !!}"><i data-feather="edit"></i><span>Sliders</span></a>
</li>

<li class="{{ Request::is('groups*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.groups.index') !!}"><i data-feather="edit"></i><span>Groups</span></a>
</li>

<li class="{{ Request::is('advisors*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.advisors.index') !!}"><i data-feather="edit"></i><span>Professional Advisor</span></a>
</li>

<li class="{{ Request::is('milestones*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.milestones.index') !!}"><i data-feather="edit"></i><span>Milestones</span></a>
</li>


<li class="nav-label mg-t-25">Variety of Products</li>
<li class="{{ Request::is('types*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.types.index') !!}"><i data-feather="edit"></i><span>Brand Types</span></a>
</li>

<li class="{{ Request::is('brands*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.brands.index') !!}"><i data-feather="edit"></i><span>Brands</span></a>
</li>

<li class="{{ Request::is('products*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.products.index') !!}"><i data-feather="edit"></i><span>Variety of Products</span></a>
</li>

<li class="nav-label mg-t-25">Section Career</li>

<li class="{{ Request::is('varians*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.varians.index') !!}"><i data-feather="edit"></i><span>Career Categories</span></a>
</li>

<li class="{{ Request::is('releases*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.releases.index') !!}"><i data-feather="edit"></i><span>Content</span></a>
</li>

<li class="nav-label mg-t-25">Articles</li>
<li class="{{ Request::is('categories*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.categories.index') !!}"><i data-feather="edit"></i><span>Categories</span></a>
</li>
<li class="{{ Request::is('contents*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.contents.index') !!}"><i data-feather="edit"></i><span>Articles</span></a>
</li>

<li class="nav-label mg-t-25">Management</li>
<li class="{{ Request::is('managements*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.managements.index') !!}"><i data-feather="edit"></i><span>Type Management</span></a>
</li>

<li class="{{ Request::is('directors*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.directors.index') !!}"><i data-feather="edit"></i><span>Directors</span></a>
</li>

<li class="nav-label mg-t-25">Documents Download</li>
<li class="{{ Request::is('jenis*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.jenis.index') !!}"><i data-feather="edit"></i><span>Jenis Documents</span></a>
</li>

<li class="{{ Request::is('documents*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.documents.index') !!}"><i data-feather="edit"></i><span>Documents</span></a>
</li>

<li class="nav-label mg-t-25">Contents</li>

<li class="{{ Request::is('careers*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.careers.index') !!}"><i data-feather="edit"></i><span>Careers</span></a>
</li>

<li class="{{ Request::is('achievements*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.achievements.index') !!}"><i data-feather="edit"></i><span>Achievements</span></a>
</li>

<li class="{{ Request::is('certifications*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.certifications.index') !!}"><i data-feather="edit"></i><span>Certifications</span></a>
</li>

<li class="{{ Request::is('testimonies*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.testimonies.index') !!}"><i data-feather="edit"></i><span>Testimonies</span></a>
</li>

<li class="{{ Request::is('announcements*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.announcements.index') !!}"><i data-feather="edit"></i><span>Announcements</span></a>
</li>

<li class="nav-label mg-t-25">Tables</li>

<li class="{{ Request::is('dividens*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.dividens.index') !!}"><i data-feather="edit"></i><span>Dividens</span></a>
</li>

<li class="{{ Request::is('shares*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.shares.index') !!}"><i data-feather="edit"></i><span>Share Information</span></a>
</li>

<li class="{{ Request::is('ownerships*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.ownerships.index') !!}"><i data-feather="edit"></i><span>Shareby Ownerships</span></a>
</li>

<li class="{{ Request::is('compositions*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.compositions.index') !!}"><i data-feather="edit"></i><span>Shareby Compositions</span></a>
</li>

<li class="{{ Request::is('positions*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.positions.index') !!}"><i data-feather="edit"></i><span>Shareby Positions</span></a>
</li>

<li class="nav-label mg-t-25">Form Submit</li>
<li class="{{ Request::is('contacts*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.contacts.index') !!}"><i data-feather="edit"></i><span>Contacts Us</span></a>
</li>

<li class="{{ Request::is('investors*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.investors.index') !!}"><i data-feather="edit"></i><span>Investors Contacts</span></a>
</li>

<li class="{{ Request::is('registrants*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.registrants.index') !!}"><i data-feather="edit"></i><span>Registrants</span></a>
</li>


<li class="nav-label mg-t-25">Default</li>
<li class="{{ Request::is('menus*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.menus.index') !!}"><i data-feather="edit"></i><span>Menus</span></a>
</li>

<li class="{{ Request::is('statuses*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.statuses.index') !!}"><i data-feather="edit"></i><span>Statuses</span></a>
</li>

<li class="{{ Request::is('parts*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.parts.index') !!}"><i data-feather="edit"></i><span>Type Sections</span></a>
</li>


<li class="{{ Request::is('sections*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.sections.index') !!}"><i data-feather="edit"></i><span>Sections</span></a>
</li>

<li class="{{ Request::is('distributions*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.distributions.index') !!}"><i data-feather="edit"></i><span>Distributions</span></a>
</li>

<li class="nav-label mg-t-25">User Management</li>
<li class="{{ Request::is('roles*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.roles.index') !!}"><i data-feather="edit"></i><span>Roles</span></a>
</li>

<li class="{{ Request::is('users*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.users.index') !!}"><i data-feather="edit"></i><span>Users</span></a>
</li>

<li class="{{ Request::is('permissions*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.permissions.index') !!}"><i data-feather="edit"></i><span>Permissions</span></a>
</li>




