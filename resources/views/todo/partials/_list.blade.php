@if (count($todos) > 1)
    @foreach ($todos as $todo)
        <div class="mb-3 bg-blue-200 p-3">
            <div class="flex justify-between items-center">
                <div>
                    <div class="text-lg font-semibold">
                        {{ $todo['task'] }}
                    </div>
                    <div class="text-xs">
                        {{ $todo['created_at'] }}
                    </div>
                </div>
                <div class="flex gap-3">
                    <button class="text-green-700">Edit</button>
                    <button class="text-red-600">Delete</button>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="bg-red-300 p-5">
        NO DATA
    </div>
@endif
