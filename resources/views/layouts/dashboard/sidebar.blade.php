@php
    $isActive = function ($patterns) {
        foreach ((array) $patterns ?? [] as $pattern) {
            if (request()->routeIs($pattern)) return true;
        }
        return false;
    };
@endphp

<aside class="admin-sidebar bg-white dark:bg-gray-800 shadow-lg rounded-xl p-5 w-full lg:w-64">

    <nav class="space-y-2">

        @foreach (config('sidebar') as $item)
            @php
                $hasChildren = isset($item['childern']) && count($item['childern']);
                $active = $isActive($item['active'] ?? []);
            @endphp

            <div class="sidebar-item">
                <a
                    @if(!$hasChildren) href="{{ route($item['link']) }}" @endif
                    class="
                        flex items-center justify-between cursor-pointer px-4 py-2 rounded-lg
                        transition-all duration-200
                        {{ $active ? 'bg-indigo-600 text-white shadow' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}
                        {{ $hasChildren ? 'sidebar-dropdown-toggle' : '' }}
                    "
                >
                    <span>{{ $item['title'] }}</span>

                    @if ($hasChildren)
                        <svg class="w-4 h-4 transform transition-transform duration-200 rtl:-rotate-90 text-gray-500 dark:text-gray-300"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7"></path>
                        </svg>
                    @endif
                </a>

                {{-- Dropdown --}}
                @if ($hasChildren)
                    <ul class="sidebar-dropdown-menu hidden mt-1 ml-4 space-y-1 border-l border-gray-300 dark:border-gray-700 pl-3">
                        @foreach ($item['childern'] as $child)
                            <li>
                                <a href="{{ route($child['link']) }}"
                                   class="
                                        block px-3 py-2 text-sm rounded-md
                                        transition-all duration-150
                                        {{ request()->routeIs($child['active'] ?? [])
                                            ? 'bg-indigo-500 text-white shadow-md'
                                            : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}
                                   ">
                                    {{ $child['title'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif

            </div>
        @endforeach

        {{-- Logout --}}
        <div class="mt-4 pt-4 border-t border-gray-300 dark:border-gray-700">
            <form id="logout-form" action="{{ route('admin.dashboard.logout') }}" method="POST" class="hidden">
                @csrf
            </form>

            <a href="#"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="flex items-center px-4 py-2 rounded-lg font-medium text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-900 transition">
                تسجيل خروج
            </a>
        </div>

    </nav>

</aside>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const toggles = document.querySelectorAll('.sidebar-dropdown-toggle');

    toggles.forEach(toggle => {
        toggle.addEventListener('click', () => {
            const parent = toggle.closest('.sidebar-item');
            const menu = parent.querySelector('.sidebar-dropdown-menu');
            const arrow = toggle.querySelector('svg');

            menu.classList.toggle('hidden');
            arrow.classList.toggle('rotate-180');
        });
    });
});
</script>
