<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <img src="assets/images/logo-text.png" width="" alt="" srcset="">
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class='sidebar-title'>Main Menu</li>
                <li class="sidebar-item {{ $title === "banner" ? 'active' : '' }}">
                    <a href="/banner" class='sidebar-link'>
                        <i data-feather="edit" width="20"></i>
                        <span>Banner</span>
                    </a>
                </li>
                <li class="sidebar-item  {{ $title === "travelling" ? 'active' : '' }}">
                    <a href="/travelling" class='sidebar-link'>
                        <i data-feather="edit" width="20"></i>
                        <span>Travelling</span>
                    </a>
                </li>
                <li class="sidebar-item  {{ $title === "artikel" ? 'active' : '' }}">
                    <a href="/artikel" class='sidebar-link'>
                        <i data-feather="edit" width="20"></i>
                        <span>Artikel</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>