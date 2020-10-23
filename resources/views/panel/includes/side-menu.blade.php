
<div id="asideAdmin">
    <aside-admin :user="{{auth()->user()}}" {{auth()->user()->isWriter() ? ':iswriter="true"' : ''}}></aside-admin>
</div>