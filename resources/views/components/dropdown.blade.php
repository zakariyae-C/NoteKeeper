@props([
    'visibility' => 'hidden lg:block'
])

<div class="dropdown {{ $visibility }} dropdown-end">
    <div tabindex="0" role="button" class="btn sc-btn ms-2 rounded-field">
        <span>{{ auth()->user()->unreadNotifications->count() }}</span>Notifications <i
            class="fa-solid fa-angle-down"></i></div>
    <ul tabindex="-1" class="menu dropdown-content bg-base-200 rounded-box z-1 mt-4 w-52 p-2 shadow-sm">
        @forelse (auth()->user()->unreadNotifications as $notification)
            <li>
                <a href="{{ route('notes.show', $notification->data['note_id']) }}" class="flex flex-col">
                    <span class="font-semibold">{{ $notification->data['note_title'] }}</span>
                    <span class="text-xs opacity-70">{{ $notification->created_at->diffForHumans() }}</span>
                </a>
            </li>
        @empty
            <li class="p-2 text-center opacity-70">No new notifications</li>
        @endforelse

        @if (auth()->user()->unreadNotifications->count() > 0)
            <li>
                <form method="POST" action="{{ route('notification.read') }}" class="justify-center">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-sm w-full mt-2">Mark all as read</button>
                </form>
            </li>
        @endif
    </ul>
</div>
