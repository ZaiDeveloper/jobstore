@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 p-3 lg:max-w-md mx-auto">

        <h2 class="mb-6 bg-green-600 text-white p-3">TASK TODO LIST</h2>

        <div class="bg-white p-3">
            <h2 class="text-gray-600 mb-3 font-semibold">Create Task</h2>
            <form id="form-add-task" action="/todos" method="POST">
                <div class="mb-3">
                    <label for="task" class="block text-sm font-medium leading-6 text-gray-900">Task<span
                            class="text-red-500">*</span></label>
                    <input id="task" type="text" name="task" value="" placeholder="Syafiq Akmal"
                        class="w-full px-3 py-1 border rounded-lg focus:outline-none focus:border-blue-500">
                    <ul class="text-sm text-red-600 space-y-1 mt-1 error-message-task">
                    </ul>
                </div>
                <button type="submit"
                    class="w-full bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 transition duration-300 disabled:opacity-75">
                    Add Task</button>
            </form>
        </div>

        <div class="border border-dashed border-b border-black my-10"></div>

        <div id="todo-list-box">
            @include('todo.partials._list')
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).on('submit', '#form-add-task', function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr("action");
            let formData = new FormData(this);
            var submitButton = form.find('button[type="submit"]');

            submitButton.prop('disabled', true);

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr(
                        'content'));
                },
                success: (response) => {
                    if (response.status) {
                        $('#new-task').val('');
                        form.find("ul").html('');

                        $('#todo-list-box').html(response.html);
                    } else {
                        alert(response.message);
                    }
                },
                error: function(response) {
                    let errors = response.responseJSON.errors;
                    form.find("ul").html('');
                    $.each(errors, function(key, value) {
                        form.find("ul.error-message-" + key).append('<li>' +
                            value + '</li>');
                    });
                },
                complete: function() {
                    setTimeout(() => submitButton.prop("disabled", false), 1000);
                }
            });
        });
    </script>
@endpush
