@if(Auth::user()->admin)
    <div class="dropdown relative inline-flex">
        <button id="dropdown-default" type="button" class="dropdown-toggle btn btn-primary" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
            Administration
            <span class="icon-[tabler--chevron-down] dropdown-open:rotate-180 size-4"></span>
        </button>
        <ul class="dropdown-menu dropdown-open:opacity-100 hidden min-w-60" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-default">
            <li><a class="dropdown-item">coming soon</a></li>
        </ul>
    </div>
@else

@endif
