@if ($message = Session::get('info'))
    <div class="flex bg-blue-100 rounded-lg p-4 mb-4 text-sm text-blue-700" role="alert">
        <div>
            <span class="font-medium">{{ $message }}</span>
        </div>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="flex bg-red-100 rounded-lg p-4 mb-4 text-sm text-red-700" role="alert">
        <div>
            <span class="font-medium">{{ $message }}</span>
        </div>
    </div>
@endif

@if ($message = Session::get('success'))
    <div class="flex bg-green-100 rounded-lg p-4 mb-4 text-sm text-green-700" role="alert">
        <div>
            <span class="font-medium">{{ $message }}</span>
        </div>
    </div>
@endif

@if($message = Session::get('warning'))
    <div class="flex bg-yellow-100 rounded-lg p-4 mb-4 text-sm text-yellow-700" role="alert">
        <div>
            <span class="font-medium">{{ $message }}</span>
        </div>
    </div>
@endif

