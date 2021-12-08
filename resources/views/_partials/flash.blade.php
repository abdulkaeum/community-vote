<div class="flex items-center justify-center">
    @if (session()->has('success'))
        <div x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 4000)"
             x-show="show"
             class="fixed bg-green-500 text-white py-3 px-3 rounded top-3 text-sm z-50">
            <div>
                <i class="fas fa-check mr-2"></i>
                {{ session()->get('success') }}
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 4000)"
             x-show="show"
             class="fixed bg-red-500 text-white py-3 px-3 rounded top-3 text-sm z-50">
            <div>
                <i class="fas fa-exclamation mr-2"></i>
                {{ session()->get('error') }}
            </div>
        </div>
    @endif

    @if (session()->has('warning'))
        <div x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 4000)"
             x-show="show"
             class="fixed bg-yellow-500 text-white py-3 px-3 rounded top-3 text-sm z-50">
            <div>
                <i class="fas fa-exclamation-triangle mr-2"></i>
                {{ session()->get('warning') }}
            </div>
        </div>
    @endif

    @if (session()->has('info'))
        <div x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 4000)"
             x-show="show"
             class="fixed bg-blue-500 text-white py-3 px-3 rounded top-3 text-sm z-50">
            <div>
                <i class="fas fa-info-circle mr-2"></i>
                {{ session()->get('info') }}
            </div>
        </div>
    @endif
</div>
