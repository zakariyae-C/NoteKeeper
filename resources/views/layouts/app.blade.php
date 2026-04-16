<!DOCTYPE html>
<html lang="en" data-theme="cupcake">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('title')</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <! -- Font Awesome CDN link -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    </head>

    <body>
        <div class="drawer md:drawer-open">
            <input id="sidebar-drawer" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content custom-drawer-content flex flex-col">
                <!-- Navbar -->
                <nav class="navbar w-full bg-base-300">
                    <!-- Mobile sidebar toggle button -->
                    <div class="flex-none md:hidden icon-toggle">
                        <label for="sidebar-drawer" class="btn btn-square btn-ghost">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linejoin="round"
                                stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor"
                                class="my-1.5 inline-block size-4">
                                <path
                                    d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2-2z">
                                </path>
                                <path d="M9 4v16"></path>
                                <path d="M14 10l2 2l-2 2"></path>
                            </svg>
                        </label>
                    </div>
                    <!-- Search input -->
                    <div class="px-4">
                        <label class="input">
                            <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none"
                                    stroke="currentColor">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <path d="m21 21-4.3-4.3"></path>
                                </g>
                            </svg>
                            <input type="search" required placeholder="Search" />
                        </label>
                    </div>
                    <!-- Add new notes button -->
                    <!-- button that open modal -->
                    <div class="ml-auto">
                        <button class="btn pr-btn" onclick="my_modal_3.showModal()">
                            <i class="fa-solid fa-plus"></i>
                            Add note
                        </button>
                    </div>
                    <!-- Modal to add a note -->
                    <dialog id="my_modal_3" class="modal">
                        <div class="modal-box">
                            <form method="dialog">
                                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                            </form>
                            <h3 class="text-lg font-bold">Add new note</h3>
                            <div>
                                <form method="POST" action="{{ route('notes.store') }}" class="fieldset w-full mt-4">
                                    @csrf
                                    <label class="label font-semibold">Title</label>
                                    <input type="text" class="input w-full" name="title"
                                        value="{{ old('title') }}" placeholder="Note title" />
                                    <x-error field="title" />

                                    <label class="label font-semibold">Description</label>
                                    <textarea class="textarea w-full" name="description" placeholder="Note description">{{ old('description') }}</textarea>
                                    <x-error field="description" />


                                    <label class="label font-semibold">Category</label>
                                    <select class="select w-full" name="category">
                                        <option disabled selected>Select category</option>
                                        <option value="personal">Personal</option>
                                        <option value="work">Work</option>
                                        <option value="idea">Idea</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <x-error field="category" />

                                    <button class="btn pr-btn mt-4">Add note</button>

                                </form>
                            </div>
                        </div>
                    </dialog>
                    <!-- Notiications dropdown -->
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn sc-btn ms-2 rounded-field"><span>{{ auth()->user()->unreadNotifications->count() }}</span>Notifications <i class="fa-solid fa-angle-down"></i></div>
                        <ul tabindex="-1"
                            class="menu dropdown-content bg-base-200 rounded-box z-1 mt-4 w-52 p-2 shadow-sm">
                            @forelse (auth()->user()->unreadNotifications as $notification)
                                <li>
                                    <a href="{{ route('notes.show',  $notification->data['note_id']) }}"
                                        class="flex flex-col">
                                        <span class="font-semibold">{{ $notification->data['note_title'] }}</span>
                                        <span class="text-xs opacity-70">{{ $notification->created_at->diffForHumans() }}</span>
                                    </a>
                                </li>
                            @empty
                                <li class="p-2 text-center opacity-70">No new notifications</li>
                            @endforelse

                            @if (auth()->user()->unreadNotifications->count() > 0)
                                <li >
                                    <form method="POST" action="{{ route('notification.read')}}" class="justify-center">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-sm w-full mt-2">Mark all as read</button>
                                    </form>
                                </li>
                            @endif
                        </ul>
                    </div>
                </nav>
                <!-- Success message alert -->
                <div class="p-4">
                    <x-success />
                </div>
                <!-- Page content here -->
                <div class="@yield('content-class', 'p-4')">
                    @yield('content')
                </div>
            </div>
            <div class="drawer-side custom-drawer-side">
                <label for="sidebar-drawer" class="drawer-overlay"></label>
                <div class="min-h-screen w-64 flex flex-col items-start bg-base-200">
                    <div class="p-6">
                        <span class="block text-2xl font-bold">NoteKeeper</span>
                        My notes, all in one place.
                    </div>
                    <ul class="menu w-full p-4 flex flex-col flex-1 border-t border-base-100/50">
                        <!-- List item -->
                        <li
                            class="{{ request()->routeIs('notes.index') && !request()->query('category') ? 'active' : '' }}">
                            <a href="{{ route('notes.index') }}" class="p-3">
                                <i class="fa-solid fa-desktop"></i>
                                <span class="ms-1">All notes</span>
                            </a>
                        </li>
                        <li class="{{ request()->query('category') === 'personal' ? 'active' : '' }}">
                            <a href="{{ route('notes.index', ['category' => 'personal']) }}" class="p-3">
                                <i class="fa-regular fa-address-book"></i>
                                <span class="ms-1">Personal</span>
                            </a>
                        </li>
                        <li class="{{ request()->query('category') === 'work' ? 'active' : '' }}">
                            <a href="{{ route('notes.index', ['category' => 'work']) }}" class="p-3">
                                <i class="fa-solid fa-briefcase"></i>
                                <span class="ms-1">Work</span>
                            </a>
                        </li>
                        <li class="{{ request()->query('category') === 'idea' ? 'active' : '' }}">
                            <a href="{{ route('notes.index', ['category' => 'idea']) }}" class="p-3">
                                <i class="fa-regular fa-lightbulb"></i>
                                <span class="ms-1">Idea</span>
                            </a>
                        </li>
                        <li class="mt-auto border border-base-300/70 rounded-md">
                            <form method="POST" action="{{ route('logout') }}" class="p-3">
                                @csrf
                                @method('DELETE')
                                <button class="w-full">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                    <span class="ms-1">Logout</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                    @php
                        $name = auth()->user()->name;
                        $words = explode(' ', $name);
                        $initials = strtoupper($words[0][0] . ($words[1][0] ?? ''));
                    @endphp
                    <div class="w-full p-4 border-t border-base-300/50">
                        <div class="avatar avatar-placeholder">
                            <div class="bg-neutral text-neutral-content w-12 rounded-full">
                                <span>{{ $initials }}</span>
                            </div>
                        </div>
                        <a href="{{ route('profile.edit', auth()->user()->id) }}"
                            class="ms-3">{{ auth()->user()->name }}</a>
                    </div>
                </div>
            </div>
        </div>

    </body>

</html>
