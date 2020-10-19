
<div id="asideAdmin">
    <aside-admin :user="{{auth()->user()}}" :iswriter="{{auth()->user()->isWriter()}}"></aside-admin>
</div>