@if (auth()->user()->isWriter())
    {{-- // render vue component for writers --}}
@else
    {{-- // render vue component for admins --}}
    <div id="asideAdmin">
        <aside-admin :user={{auth()->user()}}></aside-admin>
    </div>
@endif
