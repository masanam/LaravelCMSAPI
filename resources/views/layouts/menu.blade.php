<li class="nav-label">Dashboard</li>
<li class="{{ Request::is('stats*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! url('stats') !!}"><i data-feather="activity"></i><span>Stats</span></a>
</li>


<li class="nav-label mg-t-25">User Management</li>


<li class="{{ Request::is('users*') ? 'active' : '' }} nav-item">
    <a class="nav-link" href="{!! route('admin.users.index') !!}"><i data-feather="edit"></i><span>Users</span></a>
</li>

