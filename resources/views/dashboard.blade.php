<x-app-layout>
    <div class="p-10">
        @include('components.new-books')
    </div>
    @if(Auth::user()->is_admin)
    <div class="p-10">
        @include('components.new-users')
    </div>
    <div class="p-10">
        <h1 class="p-4 text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">Export a import dat</h1>
        <br>
        <a href="/exportData" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Export dat
        </a>
        &nbsp;&nbsp;        
        <a href="/importData" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Import dat
        </a>
    </div>
    @endif
</x-app-layout>

<script>

    if (window.location.href.indexOf("export=success") > -1) {
        window.alert("Export was successful!");
    }

    if (window.location.href.indexOf("import=success") > -1) {
        window.alert("Import was successful!");
    }

</script>