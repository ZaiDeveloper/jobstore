@if (count($todos) > 0)
    <div class="mb-3">
        <a href="{{ url('/todos/reset') }}" class="bg-gray-200 hover:bg-gray-300 px-5 py-1 rounded-lg">Erase All Taks</a>
    </div>
    @foreach ($todos as $todo)
        <div class="list-task mb-3 bg-blue-200 p-3">
            <div class="flex justify-between items-center">
                <div>
                    <div class="text-lg font-semibold">
                        {{ $todo['task'] }}
                    </div>
                    <div class="text-xs">
                        Created At: {{ $todo['created_at'] }}
                    </div>
                </div>
                <div class="flex gap-3">
                    <button class="btn-edit text-green-700 hover:underline" data-id="{{ $todo['id'] }}"
                        data-task="{{ $todo['task'] }}">Edit</button>
                    <button class="btn-delete text-red-600 hover:underline"
                        data-id="{{ $todo['id'] }}">Delete</button>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="bg-red-300 p-5">
        NO DATA
    </div>
@endif
